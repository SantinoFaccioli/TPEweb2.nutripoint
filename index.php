<?php 
    require_once 'MVC/controllers/CategoriaController.php';
    require_once 'MVC/controllers/ProductoController.php';
    require_once 'config.php';

   
            $action = $_GET['action'] ?? '';
            if (empty($action)) {
                $action = 'productos'; 
            }

        $params = explode('/', $action);

        switch ($params[0]) {
            case 'productos':
               $controller = new ProductoController;
               $controller->verTodos();
                break;
            case 'productos_cat':
                if (isset($params[1]) && is_numeric($params[1])) {
        
                    $cat_id = $params[1];
                }
                $mostraProductodById = new ProductoController;
                
                $mostraProductodById->mostrarProductosXCategoria($cat_id);
                break;
            case 'categorias':
                $controller = new CategoriaController();
                $controller->mostrarCategorias();
                break;
              case 'login':
                echo'aca va la pagina para logear al admin';
                break;
            default:
                # code...
                break;
        }
