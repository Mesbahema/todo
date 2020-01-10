@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show task</div>

                    <div class="card-body">
                        <div>
                            <strong>Title</strong>
                            <p>{{$task->title}}</p>
                        </div>
                        <div>
                            <strong>Body</strong>
                            <p>{{$task->body}}</p>
                        </div>
                        <div>
                        
                        </div>
                    </div>
                        


                </div>
            </div>
        </div>
    </div>
@endsection
