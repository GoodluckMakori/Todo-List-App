@extends('layouts.master')

@section('content')

<h1>Editing "{{ $todo->name }}"</h1>
<p class="lead">Edit and save this todo below, or <a href="{{ route('todo.index') }}">go back.</a></p>
<hr>

@include('inc.flash_notification')

@if(Session::has('inc.flash_notification'))
    <div class="alert alert-success">
        {{ Session::get('inc.flash_notification') }}
    </div>
@endif

{!! Form::open(['route' =>['todo', $todo->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <!-- Name Field -->
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Todo Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', $todo->name,['class' => 'form-control']) !!}
                <span class="help-block text-danger">
                    {{ $errors -> first('name') }}
                </span>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                {!! Form::submit('Update task', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}

<!-- 
<form action="{{ route('todo',$todo->id) }}" method="POST">
    
<div class="form-group">
    <label for="name" class="control-label">Todo Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{$todo->name}}">
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="_method" value="PUT">
<button type="submit" name="update" class="btn btn-primary">Update task</button>



</form>


@endsection