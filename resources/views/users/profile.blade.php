@extends('layouts.master')

@section('content')
    <h1>User Profile</h1>
    <hr/>

    {!! Form::model($user, ['method' => 'put', 'route' => ['user.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form','enctype'=>'multipart/form-data']) !!}
    <div style="width: 50px;padding-top:50px; float:left;">
        <img src="{{$user->profile_image}}" height="100" width="100">
    </div>
    <div style="float:left;padding-left:100px;">
        @include('users._form')
    </div>
        

        <!-- submit button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <a href="{{ url('/todo') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    {!! Form::close() !!}
@endsection