<?php

namespace App\Http\Controllers;

use DB;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * View ToDos listing.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $todoList = Todo::where('user_id', Auth::id())->where('complete', 0)->paginate(7);

        return view('todo.list', compact('todoList'));
    }

    /**
     * View Create Form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Create new Todo.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        Todo::create([
            'name' => $request->get('name'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/todo')
            ->with('flash_notification.message', 'New todo created successfully')
            ->with('flash_notification.level', 'success');
    }




    /**
     * Toggle Status.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $todo = Todo::find($id);
        $todo->complete = false;
        $todo->save();

        return redirect()
            ->route('imeisha')
            ->with('flash_notification.message', 'Todo status changed successfully')
            ->with('flash_notification.level', 'success');
    }

    /**
     * Delete Todo.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()
            ->route('todo.index')
            ->with('flash_notification.message', 'Todo deleted successfully')
            ->with('flash_notification.level', 'success');
    }

    public function edit($id)
    {
        //$todo = Todo::where('id',$id)->get();
        $todo = Todo::find($id);

        return view('todo.edit', compact('todo'));
    }

    public function kubadilisha(Request $request, $id)
    {


        $this->validate($request, [
            'name' => 'required|string'

        ]);
        $todo = Todo::find($id);
        $todo->name = $request->input('name');
        $todo->update();


        return redirect()
            ->route('todo.index')
            ->with('flash_notification.message', 'Todo Updated successfully')
            ->with('flash_notification.level', 'success');
    }
    public function imeisha($id)
    {

        $todo = Todo::where('id',$id)->update(['complete'=>'1']);

        $todos = Todo::where('user_id', Auth::id());
       
        $todos = Todo::select('name', 'complete')->where('complete' , 1)->paginate(7);
        // return $x;


        return view('todo.completetask', compact('todos'));
    }
}
