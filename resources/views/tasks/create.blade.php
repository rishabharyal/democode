@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a class="text-lg-left" href="{{ action('App\Http\Controllers\HomeController@index') }}">Go Home</a>
                        <br> {{ __('Project: ') }} <strong class="text-info">{{ $project->title }}</strong></div>

                    <div class="card-body">
                        Please add a new task from the form below.
                        <form method="post" action="@if (isset($task->id)){{ action('App\Http\Controllers\TaskController@update', $task->id) }}@else{{ action('App\Http\Controllers\TaskController@store') }}@endif">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            @if(isset($task))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input autofocus     required value="@if(isset($task)){{ $task->title }}@endif" class="form-control" type="text" id="title" name="title">
                                    </div>
                                </div>
                                <div class="col-3 offset-9">
                                    <button class="btn btn-success btn-block">@if(isset($task)) Update @else Add @endif Task</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-12" id="task_list">
                                @include('partials.tasks')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
