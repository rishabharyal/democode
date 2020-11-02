@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a class="text-lg-left" href="{{ action('App\Http\Controllers\HomeController@index') }}">Go Home</a></div>

                    <div class="card-body">
                        Please select the project from the select box below.

                        <div class="row">
                            <div class="col-12">
                                <select onchange="handleLoad()" name="project" id="project" class="form-control form-control-lg">
                                    <option disabled selected>Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12" id="task_list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
