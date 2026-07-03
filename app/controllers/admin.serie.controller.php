<?php
require_once './app/models/serie.model.php';
require_once './app/views/admin.serie.view.php';
require_once './app/helpers/auth.helper.php';

class AdminSerieController
{
    private $model;
    private $view;

    public function __construct()
    {
        AuthHelper::verify();
        $this->model = new SerieModel();
        $this->view  = new AdminSerieView();
    }

    public function index()
    {
        $series = $this->model->getSeries();
        $this->view->showSeries($series);
    }

    public function create()
    {
        $this->view->showFormAlta();
    }

    public function store()
    {
        $nombre      = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if (empty($nombre)) {
            $this->view->showFormAlta('El nombre es obligatorio');
            return;
        }

        $id = $this->model->insertarSerie($nombre, $descripcion);
        if ($id) {
            header('Location: ' . BASE_URL . 'admin/series');
        } else {
            $this->view->showError('Error al insertar la serie');
        }
    }

    public function destroy($id)
    {
        $this->model->deleteSerie($id);
        header('Location: ' . BASE_URL . 'admin/series');
    }
}
