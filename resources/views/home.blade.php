@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todo App') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You can add, update or delete the to-do application from here.</p>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ action(\App\Http\Controllers\ProjectController::class .  '@create') }}" class="btn btn-block btn-success">
                                Add New Project
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ action(\App\Http\Controllers\ProjectController::class . '@index') }}" class="btn btn-block btn-success">
                                Show All Projects
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="mt-3 pt-0 text-center text-info">Your Projects</h5>
                        </div>
                        <table class="table table-striped mt-3">
                            <tr>
                                <th colspan="4" class="text-center">
                                    <strong>Projects</strong>
                                </th>
                            </tr>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th># of Tasks</th>
                                <th>Action</th>
                            </tr>
                            @if($projects->count())
                                @foreach($projects as $index => $project)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>
                                            <a href="{{ action('App\Http\Controllers\TaskController@create', ['pid' => $project->id]) }}">
                                                {{ $project->title }}
                                            </a>
                                        </td>
                                        <td>{{ $project->tasks()->count() }}</td>
                                        <td>
                                            <form method="post" action="{{ action(\App\Http\Controllers\ProjectController::class . '@destroy', $project->id) }}">
                                                @method('delete')
                                                @csrf
                                                <a class="btn btn-info btn-sm" href="{{ action('App\Http\Controllers\TaskController@create', ['pid' => $project->id]) }}">
                                                    Add Tasks
                                                </a>
                                                <a class="btn btn-sm btn-info" href="{{ action(\App\Http\Controllers\ProjectController::class . '@edit', $project->id) }}">Edt</a>
                                                <button class="btn btn-sm btn-danger" href="{{ action(\App\Http\Controllers\ProjectController::class . '@destroy', $project->id) }}">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                   <th colspan="4" class="text-center text-danger">
                                       There are no projects yet!
                                   </th>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
