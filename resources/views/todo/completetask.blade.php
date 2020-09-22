@extends('layouts.master')

@section( 'content')

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ToDo Name</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($todos as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->complete ? 'Complete' : 'Incomplete' }}</td>
                        
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $todos->render() !!}
        </div>
            
        </div>
    
@endsection