<?php

class PiezaModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }

    function getPiezas($page = 1, $limit = 4)
    {
        $offset = ($page - 1) * $limit;
        $query  = $this->db->prepare(
            'SELECT piezas.*, series.nombre AS nombre_serie 
         FROM piezas 
         JOIN series ON piezas.id_serie = series.id
         LIMIT :limit OFFSET :offset'
        );
        $query->bindValue(':limit',  $limit,  PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function countPiezas()
    {
        $query = $this->db->prepare('SELECT COUNT(*) FROM piezas');
        $query->execute();
        return $query->fetchColumn();
    }

    function getPiezaById($id)
    {
        $query = $this->db->prepare(
            'SELECT piezas.*, series.nombre AS nombre_serie 
         FROM piezas 
         JOIN series ON piezas.id_serie = series.id 
         WHERE piezas.id = ?'
        );
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertarPieza($titulo, $descripcion, $materiales, $anio, $id_serie)
    {
        $query = $this->db->prepare(
            'INSERT INTO piezas (titulo, descripcion, materiales, anio, id_serie) VALUES(?,?,?,?,?)'
        );
        $query->execute([$titulo, $descripcion, $materiales, $anio, $id_serie]);
        return $this->db->lastInsertId();
    }


    function deletePieza($id)
    {
        $query = $this->db->prepare('DELETE FROM piezas WHERE id = ?');
        $query->execute([$id]);
    }

    function updatePieza($id, $titulo, $descripcion, $materiales, $anio, $id_serie)
    {
        $query = $this->db->prepare(
            'UPDATE piezas SET titulo=?, descripcion=?, materiales=?, anio=?, id_serie=? WHERE id=?'
        );
        $query->execute([$titulo, $descripcion, $materiales, $anio, $id_serie, $id]);
    }

    function getPiezasApi($page = 1, $limit = 5, $orderBy = 'id', $dir = 'asc', $id_serie = null)
    {
        $camposValidos = ['id', 'titulo', 'anio', 'materiales', 'estado', 'id_serie'];
        if (!in_array($orderBy, $camposValidos)) $orderBy = 'id';
        $dir    = strtolower($dir) === 'desc' ? 'DESC' : 'ASC';
        $offset = ($page - 1) * $limit;
        $where  = $id_serie ? 'WHERE piezas.id_serie = :id_serie' : '';

        $sql   = "SELECT piezas.*, series.nombre AS nombre_serie
              FROM piezas
              JOIN series ON piezas.id_serie = series.id
              $where
              ORDER BY piezas.$orderBy $dir
              LIMIT :limit OFFSET :offset";

        $query = $this->db->prepare($sql);
        if ($id_serie) $query->bindValue(':id_serie', $id_serie, PDO::PARAM_INT);
        $query->bindValue(':limit',  $limit,  PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function countPiezasApi($id_serie = null)
    {
        $where = $id_serie ? 'WHERE id_serie = ?' : '';
        $query = $this->db->prepare("SELECT COUNT(*) FROM piezas $where");
        $query->execute($id_serie ? [$id_serie] : []);
        return (int)$query->fetchColumn();
    }
}
