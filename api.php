<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/libs/router.php';
require_once __DIR__ . '/app/helpers/auth.api.helper.php';
require_once __DIR__ . '/app/controllers/pieza.api.controller.php';
$router = new Router();

$router->addRoute('piezas',     'GET',  'PiezaApiController', 'get');
$router->addRoute('piezas',     'POST', 'PiezaApiController', 'create');
$router->addRoute('piezas/:ID', 'GET',  'PiezaApiController', 'get');
$router->addRoute('piezas/:ID', 'PUT',  'PiezaApiController', 'update');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
