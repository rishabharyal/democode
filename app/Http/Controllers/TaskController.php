<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStore;
use App\Models\Task;
use App\Repos\Projects;
use App\Repos\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $projectRepo;
    private $taskRepo;

    public function __construct(Projects $projects, Tasks $tasks)
    {
        $this->projectRepo = $projects;
        $this->taskRepo = $tasks;
    }

    public function getPartial($id) {
        $project = $this->projectRepo->find($id);
        return view('partials.tasks', compact('project'));
    }

    /**
     * Order The ids.
     *
     * @param Request $request
     * @return void
     */
    public function order(Request $request)
    {
        $dragId = $request->get('dragged_item');
        $targetId = $request->get('target_item');
        $dragIndex = $request->get('drag_index');
        $dropIndex = $request->get('drop_index');
        $projectId = $request->get('project_id');

        $this->taskRepo->order($projectId, $dragId, $dragIndex, $targetId, $dropIndex);

        $project = $this->projectRepo->find($projectId);
        return view('partials.tasks', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = $this->projectRepo->find($request->get('pid'));
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStore $request)
    {
        $this->taskRepo->create($request->except(['_token']));
        return redirect()->back()->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $project = $this->projectRepo->find($task->project_id);
        return view('tasks.create', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskStore $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStore $request, Task $task)
    {
        $this->taskRepo->update($task->id, $request->except(['_token', 'project_id', '_method']));
        return redirect()->action(TaskController::class . '@create', ['pid' => $request->project_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
