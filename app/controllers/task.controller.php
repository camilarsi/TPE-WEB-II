<?php
require_once './app/models/task.model.php';
require_once './app/views/task.view.php';
require_once './app/helpers/auth.helper.php';

class TaskController {
    private $model;
    private $view;

    public function __construct() {
        // verifico logueado
        AuthHelper::verify();

        $this->model = new TaskModel();
        $this->view = new TaskView();
    }

    public function showTasks() {
        // obtengo tareas del controlador
        $tasks = $this->model->getTasks();
        
        // muestro las tareas desde la vista
        $this->view->showTasks($tasks);
    }

    public function addTask() {

        // obtengo los datos del usuario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];

        // validaciones
        if (empty($title) || empty($priority)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertTask($title, $description, $priority);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    }

    function removeTask($id) {
        $this->model->deleteTask($id);
        header('Location: ' . BASE_URL);
    }
    
    function finishTask($id) {
        $this->model->updateTask($id);
        header('Location: ' . BASE_URL);
    }

}