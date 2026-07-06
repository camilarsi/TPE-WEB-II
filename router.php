<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once './app/controllers/pieza.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './config.php';
require_once './app/controllers/admin.pieza.controller.php';
require_once './app/controllers/admin.serie.controller.php';
require_once './app/controllers/serie.controller.php';


$action = 'piezas'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// about ->             aboutController->showAbout();
// login ->             authContoller->showLogin();
// logout ->            authContoller->logout();
// auth                 authContoller->auth(); // toma los datos del post y autentica al usuario
// piezas ->           piezasController->showPiezas();

$params = explode('/', $action);

switch ($params[0]) {

    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'piezas':
        $controller = new PiezaController();
        if (isset($params[1])) {
            $controller->show($params[1]);
        } else {
            $controller->showPiezas();
        }
        break;
        break;
    case 'series':
        $controller = new SerieController();
        if (isset($params[1])) {
            $controller->show($params[1]);
        } else {
            $controller->index();
        }
        break;
    case 'admin':
        if (!isset($params[1])) break;

        switch ($params[1]) {
            case 'piezas':
                $controller = new AdminPiezaController();
                if (isset($params[2]) && $params[2] === 'nueva') {
                    $controller->create();
                } elseif (isset($params[3]) && $params[3] === 'editar') {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller->update($params[2]);
                    } else {
                        $controller->edit($params[2]);
                    }
                } elseif (isset($params[3]) && $params[3] === 'eliminar') {
                    $controller->destroy($params[2]);
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->store();
                } else {
                    $controller->index();
                }
                break;
            case 'series':
                $controller = new AdminSerieController();
                if (isset($params[2]) && $params[2] === 'nueva') {
                    $controller->create();
                } elseif (isset($params[3]) && $params[3] === 'eliminar') {
                    $controller->destroy($params[2]);
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->store();
                } else {
                    $controller->index();
                }
                break;
        }
        break;
    default:
        echo "404 Page Not Found";
        break;
}
