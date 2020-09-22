@extends('layouts.master')

@section('content')
    <h1>Todo List <a href="{{ url('/todo/create') }}" class="btn btn-primary pull-right btn-sm">Add New Todo</a></h1>
    <hr/>

    @include('inc.flash_notification')

    @if(count($todoList))
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ToDo Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($todoList as $todo)
                    <tr>
                        <td>{{ $todo->name }}</td>
                        <td>{{ $todo->complete?  : 'Pending' }}</td>
                        <td>
                            {{-- {!! Form::open(['route' => ['todocomplete', $todo->id], 'class' => 'form-inline', 'method' => 'put']) !!} --}}
                                {{-- @if($todo->complete) --}}
                                
                                <a href="{{ route('imeisha', $todo->id) }}" class="btn btn-success btn-xs">Complete</a>
                                    
                                
                                {{-- {!! Form::submit('complete', ['class' => 'btn btn-success btn-xs']) !!}
                            {!! Form::close() !!}  --}}
                            

                            {!! Form::open(['route' => ['todo.destroy', $todo->id], 'class' => 'form-inline', 'method' => 'delete']) !!}
                                {!! Form::hidden('id', $todo->id) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}

                            {!! Form::close() !!}
                            <a href="{{route('todo', $todo->id) }}" class="btn btn-primary btn-xs">Edit Task</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $todoList->render() !!}
        </div>
    @else
        <div class="text-center">
            <h3>No Todo List added</h3>
            
        </div>
    @endif
@endsection