<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/pieza.model.php';

class PiezaApiController extends ApiController
{
    private $model;
    private $authHelper;

    function __construct()
    {
        parent::__construct();
        $this->model      = new PiezaModel();
        $this->authHelper = new AuthApiHelper();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $piezas = $this->model->getPiezasApi();
            $this->view->response($piezas, 200);
        } else {
            $pieza = $this->model->getPiezaById($params[':ID']);
            if ($pieza) {
                $this->view->response($pieza, 200);
            } else {
                $this->view->response('La pieza con id=' . $params[':ID'] . ' no existe.', 404);
            }
        }
    }

    function create($params = [])
    {
        if (!$this->authHelper->currentUser()) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        $body        = $this->getData();
        $titulo      = $body->titulo ?? null;
        $descripcion = $body->descripcion ?? null;
        $materiales  = $body->materiales ?? null;
        $anio        = $body->anio ?? null;
        $id_serie    = $body->id_serie ?? null;

        if (empty($titulo) || empty($materiales) || empty($id_serie)) {
            $this->view->response('Faltan campos obligatorios: titulo, materiales, id_serie', 400);
            return;
        }

        $id    = $this->model->insertarPieza($titulo, $descripcion, $materiales, $anio, null, $id_serie);
        $pieza = $this->model->getPiezaById($id);
        $this->view->response($pieza, 201);
    }

    function update($params = [])
    {
        if (!$this->authHelper->currentUser()) {
            $this->view->response('Unauthorized', 401);
            return;
        }

        $id    = $params[':ID'];
        $pieza = $this->model->getPiezaById($id);

        if (!$pieza) {
            $this->view->response('La pieza con id=' . $id . ' no existe.', 404);
            return;
        }

        $body        = $this->getData();
        $titulo      = $body->titulo ?? $pieza->titulo;
        $descripcion = $body->descripcion ?? $pieza->descripcion;
        $materiales  = $body->materiales ?? $pieza->materiales;
        $anio        = $body->anio ?? $pieza->anio;
        $id_serie    = $body->id_serie ?? $pieza->id_serie;

        $this->model->updatePieza($id, $titulo, $descripcion, $materiales, $anio, $id_serie);
        $pieza = $this->model->getPiezaById($id);
        $this->view->response($pieza, 200);
    }
}
