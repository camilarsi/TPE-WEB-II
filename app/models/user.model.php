<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }

    public function getUsuario($usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$usuario]);
       

    
        return $query->fetch(PDO::FETCH_OBJ);
    }
}