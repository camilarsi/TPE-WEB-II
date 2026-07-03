<?php
require_once './app/models/serie.model.php';
require_once './app/views/serie.view.php';

class SerieController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new SerieModel();
        $this->view  = new SerieView();
    }

    public function index()
    {
        $series = $this->model->getSeries();
        $this->view->showSeries($series);
    }

    public function show($id)
    {
        $serie  = $this->model->getSerieById($id);
        $piezas = $this->model->getPiezasBySerie($id);
        $this->view->showSerie($serie, $piezas);
    }
}
