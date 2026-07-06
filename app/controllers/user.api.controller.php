<?php
require_once __DIR__ . '/../controllers/api.controller.php';
require_once __DIR__ . '/../helpers/auth.api.helper.php';
require_once __DIR__ . '/../models/user.model.php';

class UserApiController extends ApiController
{
    private $model;
    private $authHelper;

    function __construct()
    {
        parent::__construct();
        $this->authHelper = new AuthApiHelper();
        $this->model      = new UserModel();
    }

    function getToken($params = [])
    {
        $basic = $this->authHelper->getAuthHeaders();
        if (empty($basic)) {
            $this->view->response('No envió encabezados de autenticación.', 401);
            return;
        }

        $basic = explode(" ", $basic);
        if ($basic[0] != "Basic") {
            $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            return;
        }

        $userpass = base64_decode($basic[1]);
        $userpass = explode(":", $userpass);
        $user     = $userpass[0];
        $pass     = $userpass[1];

        $userdata = $this->model->getUsuario($user);
        if ($userdata && password_verify($pass, $userdata->password)) {
            $payload = ['id' => $userdata->id, 'usuario' => $userdata->usuario];
            $token   = $this->authHelper->createToken($payload);
            $this->view->response($token);
        } else {
            $this->view->response('Usuario o contraseña incorrectos.', 401);
        }
    }
}
