<?php
require_once './app/models/pieza.model.php';
require_once './app/views/pieza.view.php';
require_once './app/models/serie.model.php';
require_once './app/helpers/auth.helper.php';

class PiezaController
{
    private $model;
    private $view;
    private $serieModel;

    public function __construct()
    {
        // verifico logueado
        //AuthHelper::verify(); implementar para admin

        $this->model = new PiezaModel();
        $this->view = new PiezaView();
        $this->serieModel = new SerieModel();
    }

    public function showPiezas()
    {
        $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit  = 4;
        $total  = $this->model->countPiezas();
        $pages  = ceil($total / $limit);
        $piezas = $this->model->getPiezas($page, $limit);
        $series = $this->serieModel->getSeries();
        $this->view->showPiezas($piezas, $series, $page, $pages);
    }

    public function addPieza()
    {

        // obtengo los datos del usuario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $materiales = $_POST['materiales'];
        $id_serie = $_POST['id_serie'];


        // validaciones
        if (empty($title) || empty($description) || empty($materiales) || empty($id_serie)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertarPieza($title, $description, $materiales, $id_serie);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar la pieza");
        }
    }

    function removePieza($id)
    {
        $this->model->deletePieza($id);
        header('Location: ' . BASE_URL);
    }

    public function show($id)
    {
        $pieza = $this->model->getPiezaById($id);
        $this->view->showPieza($pieza);
    }
}
