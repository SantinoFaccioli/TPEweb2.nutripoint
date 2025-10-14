<?php 
    require_once 'MVC/controllers/CategoriaController.php';
    require_once 'MVC/controllers/ProductoController.php';
    require_once 'config.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    // accion por defecto si no se envia ninguna
        $action = 'productos'; 
        if (!empty( $_GET['action'])) {
            $action = $_GET['action'];
        };

        $params = explode('/', $action);

        switch ($params[0]) {
            case 'productos':
                //aca deberia ir lo de mostrar todos los productos
                break;
            case 'productos_cat':
                
                break;
            default:
                # code...
                break;
        }
