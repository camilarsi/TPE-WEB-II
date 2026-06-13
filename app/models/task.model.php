<?php

class TaskModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */
    function getTasks() {
        $query = $this->db->prepare('SELECT * FROM tareas');
        $query->execute();

        // $tasks es un arreglo de tareas
        $tasks = $query->fetchAll(PDO::FETCH_OBJ);

        return $tasks;
    }

    /**
     * Inserta la tarea en la base de datos
     */
    function insertTask($title, $description, $priority) {
        $query = $this->db->prepare('INSERT INTO tareas (titulo, descripcion, prioridad) VALUES(?,?,?)');
        $query->execute([$title, $description, $priority]);

        return $this->db->lastInsertId();
    }

    
function deleteTask($id) {
    $query = $this->db->prepare('DELETE FROM tareas WHERE id = ?');
    $query->execute([$id]);
}

function updateTask($id) {    
    $query = $this->db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
    $query->execute([$id]);
}
}