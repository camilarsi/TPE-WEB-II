<?php
require_once './app/models/pieza.model.php';
require_once './app/views/pieza.view.php';
require_once './app/models/serie.model.php';

class PiezaController
{
    private $model;
    private $view;
    private $serieModel;

    public function __construct()
    {
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

    public function show($id)
    {
        $pieza = $this->model->getPiezaById($id);
        $this->view->showPieza($pieza);
    }
}
