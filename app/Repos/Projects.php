<?php


namespace App\Repos;


use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class Projects
{
    private $projectModel;
    public function __construct(Project $project)
    {
        $this->projectModel = $project;

    }

    public function get() {
        return $this->projectModel->where('user_id', Auth::id())->get();
    }

    public function find($id) {
        return $this->projectModel->find($id);
    }

    public function delete($id) {
        $project = $this->projectModel->where('id', $id)->first();
        $project->tasks()->delete();
        $project->delete();
    }

    public function create($data) {
        $data['user_id'] = Auth::id();
        $this->projectModel->create($data);
    }

    public function update($id, $data) {
        $this->projectModel->where('id', $id)->update($data);
    }

}
