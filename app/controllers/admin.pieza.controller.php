<?php
require_once './app/models/pieza.model.php';
require_once './app/models/serie.model.php';
require_once './app/views/admin.pieza.view.php';
require_once './app/helpers/auth.helper.php';

class AdminPiezaController
{
    private $model;
    private $view;
    private $serieModel;

    public function __construct()
    {
        AuthHelper::verify();
        $this->model      = new PiezaModel();
        $this->view       = new AdminPiezaView();
        $this->serieModel = new SerieModel();
    }

    public function index()
    {
        $piezas = $this->model->getPiezas();
        $this->view->showPiezas($piezas);
    }

    public function create()
    {
        $series = $this->serieModel->getSeries();
        $this->view->showFormAlta($series);
    }

    public function store()
    {
        $titulo      = $_POST['title'];
        $descripcion = $_POST['description'];
        $materiales  = $_POST['materiales'];
        $anio        = $_POST['anio'];
        $id_serie    = $_POST['id_serie'];

        if (empty($titulo) || empty($materiales) || empty($id_serie)) {
            $series = $this->serieModel->getSeries();
            $this->view->showFormAlta($series, 'Faltan completar campos obligatorios');
            return;
        }

        $id = $this->model->insertarPieza($titulo, $descripcion, $materiales, $anio, $id_serie);
        if ($id) {
            header('Location: ' . BASE_URL . 'admin/piezas');
        } else {
            $this->view->showError('Error al insertar la pieza');
        }
    }

    public function destroy($id)
    {
        $this->model->deletePieza($id);
        header('Location: ' . BASE_URL . 'admin/piezas');
    }

    public function edit($id)
    {
        $pieza  = $this->model->getPiezaById($id);
        $series = $this->serieModel->getSeries();
        $this->view->showFormEditar($pieza, $series);
    }

    public function update($id)
    {
        $titulo      = $_POST['title'];
        $descripcion = $_POST['description'];
        $materiales  = $_POST['materiales'];
        $anio        = $_POST['anio'];
        $id_serie    = $_POST['id_serie'];

        $this->model->updatePieza($id, $titulo, $descripcion, $materiales, $anio, $id_serie);
        header('Location: ' . BASE_URL . 'admin/piezas');
    }
}
