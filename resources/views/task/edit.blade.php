@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create task</div>

                    <div class="card-body">
                        <form action="/task/{{$task->id}}" method="post">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="title" value="{{$task->title}}">
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea class="form-control" name="body">{{$task->body}}</textarea>
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
