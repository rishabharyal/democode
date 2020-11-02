<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStore;
use App\Http\Requests\ProjectUpdate;
use App\Models\Project;
use App\Repos\Projects;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    private $projectRepo;
    public function __construct(Projects  $projects)
    {
        $this->projectRepo = $projects;
    }

    /**
     * Get the list of all the available projects
     */
    public function index() {
        $projects = $this->projectRepo->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStore $request)
    {
        $this->projectRepo->create($request->except('_token'));

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.create', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectStore $request, Project $project)
    {
        $this->projectRepo->update($project->id, $request->except(['_token', '_method']));

        return redirect()->back()->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->projectRepo->delete($project->id);

        return redirect()->route('home')->with('success', 'Project and its task deleted successfully!');
    }
}
