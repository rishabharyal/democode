<table class="table table-striped mt-3">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    @foreach($project->tasks as $index=>$task)
        <tr ondrop="drop(event)" ondragover="preventDrop(event)" draggable="true" ondragstart="drag(event)" data-id="{{ $task->id }}" data-pid="{{ $task->project_id }}" data-priority="{{ $task->priority }}">
            <td>{{ $index+1 }}</td>
            <th id="task_title_{{$task->id}}">{{ $task->title }}</th>
            <th>
                <a class="btn btn-sm btn-info" href="{{ action(\App\Http\Controllers\TaskController::class . '@edit', $task->id) }}">Edt</a>
                <button class="btn btn-sm btn-danger" href="{{ action(\App\Http\Controllers\TaskController::class . '@destroy', $task->id) }}">Delete</button>
            </th>
        </tr>
    @endforeach
</table>
