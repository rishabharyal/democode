@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ action('App\Http\Controllers\HomeController@index') }}">Go Home</a> | {{ __('Projects') }}</div>

                    <div class="card-body">
                        Please add a new project from the form below.
                        <form method="post" action="@if (isset($project->id)){{ action('App\Http\Controllers\ProjectController@update', $project->id) }}@else{{ action('App\Http\Controllers\ProjectController@store') }}@endif">
                            @csrf
                            @if(isset($project))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input required value="@if(isset($project)){{ $project->title }}@endif" class="form-control" type="text" id="title" name="title">
                                    </div>
                                </div>
                                <div class="col-3 offset-9">
                                    <button class="btn btn-success btn-block">@if(isset($project)) Update @else Add @endif Project</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
