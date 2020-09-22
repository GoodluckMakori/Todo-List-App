<?php

namespace App\Http\Controllers;

use Image;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update']]);
    }

    /**
     * Show User Registration Form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('users.create');
    }

    /**
     * Register User
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->profile_image = $request->input('profile_image');
        $user->password = bcrypt($request->input('password'));
        if ($user->save()) {
            # code...
            $photo = $request->file('profile_image');

            if ($photo != null) {
                # code...
                $ext = $photo->getClientOriginalExtension();
                $filename = rand(10000, 50000) . '.' . $ext;
                if ($photo->move(public_path(), $filename)) {
                    # code...
                    $user = User::find($user->id);
                    $user->profile_image = url('/') . '/' . $filename;
                    $user->save();
                }
            }
        }

        return redirect('login')
            ->with('flash_notification.message', 'User registered successfully')
            ->with('flash_notification.level', 'success');
    }

    /**
     * Show User Profile
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.profile', compact('user'));
    }

    /**
     * Update User Profile
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email',
            'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'  => 'confirmed'
        ]);

        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->profile_image = $request->get('profile_image');
        $photo = $request->file('profile_image');

        if ($photo != null) {
            # code...
            $ext = $photo->getClientOriginalExtension();
            $filename = rand(10000, 50000) . '.' . $ext;
            if ($photo->move(public_path(), $filename)) {
                # code...
                $user = User::find($user->id);
                $user->profile_image = url('/') . '/' . $filename;
                $user->save();
            }
        }


        if ($request->get('password') !== '') {
            $user->password = $request->get('password');
        }
        $user->save();

        return redirect('/todo')
            ->with('flash_notification.message', 'Profile updated successfully')
            ->with('flash_notification.level', 'success');
    }
}
