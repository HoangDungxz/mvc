<?php
namespace MVC\Models;
use MVC\Models\TaskResourceModel;

class TaskRepository
{
    function add($model){
        $taskResourceModel = new TaskResourceModel;
        return $taskResourceModel->save($model);
    }
    public function delete($id)
    {
        $taskResourceModel = new TaskResourceModel;
        return $taskResourceModel->delete($id);
    }
    public function get($id = null)
    {
        $taskResourceModel = new TaskResourceModel;
        return $taskResourceModel->select($id);
    }
}
