<?php


namespace App\Repos;


use App\Models\Task;
use Illuminate\Support\Facades\DB;

class Tasks
{
    /**
     * @var Task
     */
    private $taskModel;

    public function __construct(Task $task)
    {
        $this->taskModel = $task;
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function get($projectId) {
        return $this->taskModel->where('project_id', $projectId)->get();
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $task = $this->taskModel->where('id', $id)->first();
        $task->delete();
    }

    /**
     * @param $data
     */
    public function create($data) {
        $lastData = $this->taskModel->where('project_id', $data['project_id'])->orderBy('priority', 'DESC')->first();
        $data['priority'] = ($lastData->priority ?? 0) + 1;
        $this->taskModel->create($data);
    }

    /**
     * @param $id
     * @param $data
     */
    public function update($id, $data) {
        $this->taskModel->where('id', $id)->update($data);
    }

    public function order($projectId, $dragId, $dragIndex, $targetId, $dropIndex) {
        if ($dragIndex > $dropIndex) {
            DB::statement(
                "UPDATE `tasks` SET `tasks`.`priority` = `tasks`.`priority` + 1
                WHERE `tasks`.`priority` < $dragIndex
                AND `tasks`.`priority` >= $dropIndex
                AND `tasks`.`project_id` = $projectId");
            $this->taskModel->where('id', $dragId)->update([
                'priority' => $dropIndex
            ]);
            return;
        }

        if ($dropIndex > $dragIndex) {
            DB::statement(
                "UPDATE `tasks` SET `tasks`.`priority` = `tasks`.`priority` - 1
                WHERE `tasks`.`priority` > $dragIndex
                AND `tasks`.`priority` <= $dropIndex
                AND `tasks`.`project_id` = $projectId");
            $this->taskModel->where('id', $dragId)->update([
                'priority' => $dropIndex
            ]);
            return;
        }
    }

}
