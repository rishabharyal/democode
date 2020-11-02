<?php

namespace App\Http\Controllers;

use App\Repos\Projects;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $projectRepo;

    /**
     * Create a new controller instance.
     *
     * @param Projects $projects
     */
    public function __construct(Projects $projects)
    {
        $this->projectRepo = $projects;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $projects = $this->projectRepo->get();
        return view('home', compact('projects'));
    }
}
