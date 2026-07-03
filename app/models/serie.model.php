<?php

class SerieModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }

    function getSeries()
    {
        $query = $this->db->prepare('SELECT * FROM series');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getSerieById($id)
    {
        $query = $this->db->prepare('SELECT * FROM series WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertarSerie($nombre, $descripcion)
    {
        $query = $this->db->prepare('INSERT INTO series (nombre, descripcion) VALUES(?,?)');
        $query->execute([$nombre, $descripcion]);
        return $this->db->lastInsertId();
    }

    function deleteSerie($id)
    {
        $query = $this->db->prepare('DELETE FROM series WHERE id = ?');
        $query->execute([$id]);
    }

    function getPiezasBySerie($id)
    {
        $query = $this->db->prepare('SELECT * FROM piezas WHERE id_serie = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
