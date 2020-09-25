<?php

namespace MVC\Controllers;


use MVC\Core\Controller;
use MVC\Models\TaskModel;
use MVC\Models\TaskRepository;


class TasksController extends Controller
{
   function index()
   {
      $taskRepository = new TaskRepository;

      $d['tasks'] = $taskRepository->get();

      $this->set($d);
      $this->render("index");
   }

   function create()
   {
      if (isset($_POST["title"])) {

         $taskModel = new TaskModel;
         $taskRepository = new TaskRepository;


         $taskModel->setTitle($_POST["title"]);
         $taskModel->setDescription($_POST["description"]);
         $taskModel->setCreatedAt(date('Y-m-d H:i:s'));

         if ($taskRepository->add($taskModel)) {
            header("Location: " . WEBROOT . "tasks/index");
         }
      }
      $this->render("create");
   }

   function edit($id)
   {

      $taskRp = new TaskRepository();

      $d["task"] = $taskRp->get($id);
      if (isset($_POST["title"])) {

         $taskModel = new TaskModel;
         $taskRepository = new TaskRepository;

         $taskModel->setId($id);
         $taskModel->setTitle($_POST["title"]);
         $taskModel->setDescription($_POST["description"]);
         $taskModel->setUpdatedAt(date('Y-m-d H:i:s'));

         if ($taskRepository->add($taskModel)) {
            header("Location: " . WEBROOT . "tasks/index");
         }
      }
      $this->set($d);
      $this->render("edit");
   }


   function delete($id)
   {
      $taskRepository = new TaskRepository;

      if ($taskRepository->delete($id)) {
         header("Location: " . WEBROOT . "tasks/index");
      }
   }
}
