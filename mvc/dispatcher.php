<?php
namespace MVC;

use MVC\Controllers\TasksController;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {

        $nameCT = "MVC\\Controllers\\" . ucfirst($this->request->controller) . "Controller";

        $controller = new TasksController();

        return $controller;
    }

}
?>