@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>TODO List</h1>
                <form action="/search" method="post">
                    @csrf

                    <div class="form-group">
                        <input class="form-control mb-4 mt-2 col-md-3" name="search">
                    <button type="submit">Search</button>
                    </div>
                </form>
                <div class="card">
            
                    <div class="card-header">Create New Task</div>

                    <div class="card-body">
                        <a href="/task/create" class="btn btn-success">Create</a>
                    </div>

                    <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Created By</th>
                                <th scope="col"></th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <th scope="row">{{$task->id}}</th>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->body}}</td>
                                    <td>{{$task->user->name}}</td>
                                    <td>
                                        <a href="/task/{{$task->id}}" class="btn btn-primary">Show</a>
                                    </td>
                                    <td>
                                        <a href="/task/{{$task->id}}/edit" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="/task/{{$task->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    <td>{{$task->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                

            </div>
        </div>
    </div>
@endsection
