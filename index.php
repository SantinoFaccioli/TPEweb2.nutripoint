<?php 
require_once 'MVC/controllers/CategoriaController.php';
require_once 'MVC/controllers/ProductoController.php';
require_once 'MVC/controllers/AdminController.php'; 
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
        
    case 'detalle_producto': 
        if (isset($params[1]) && is_numeric($params[1])) {
            $id_producto = $params[1];
            $controller = new ProductoController();
            $controller->detalle($id_producto);
        } else {
            header('Location: ' . BASE_URL . 'productos');
        }
        break;

    case 'productos_cat':
        if (isset($params[1]) && is_numeric($params[1])) {
            $cat_id = $params[1];
        } else {
            $cat_id = 0; 
        }
        $controller = new ProductoController; 
        $controller->mostrarProductosXCategoria($cat_id);
        break;
        
    case 'categorias':
        $controller = new CategoriaController();
        $controller->mostrarCategorias();
        break;

    case 'register': 
        $controller = new AdminController();
        $controller->mostrarRegistro(); // <-- Método para mostrar la vista de registro
        break;

    case 'login':
        $controller = new AdminController();
        $controller->mostrarLogin(); 
        break;

    case 'validar_login':
        $controller = new AdminController();
        $controller->validar(); 
        break;

    case 'logout':
        $controller = new AdminController();
        $controller->logout();
        break;

    case 'admin':
        $adminController = new AdminController();
        $adminController->checkLogin(); 
        $accionAdmin = $params[1] ?? 'dashboard'; 

        switch ($accionAdmin) {
            case 'productos': 
                $prodController = new ProductoController();
                $prodController->adminListarProductos(); 
                break;
            
            case 'agregar_producto':
                $prodController = new ProductoController();
                $prodController->adminAgregarProducto(); 
                break;

            case 'eliminar_producto': 
                $id = $params[2] ?? 0;
                $prodController = new ProductoController();
                $prodController->adminEliminarProducto($id);
                break;
           case 'eliminar_producto': 
                $id = $params[2] ?? 0;
                $prodController = new ProductoController();
                $prodController->adminEliminarProducto($id);
                break;
                
            case 'editar_producto': 
                $id = $params[2] ?? 0;
                $prodController = new ProductoController();
                $prodController->adminMostrarFormularioEditar($id);
                break;

            case 'procesar_edicion': 
                $prodController = new ProductoController();
                $prodController->adminProcesarEdicion();
               break;
<<<<<<< Updated upstream
            
            case 'categorias': 
                $catController = new CategoriaController();
                $catController->adminListarCategorias();
               break;
            
            case 'eliminar_categoria': 
                $cat_id = $params[2];
                $catController = new CategoriaController();
                $catController->eliminarCategoria($cat_id);
               break; 
            case 'agregar_categoria':
                
                $catController =new CategoriaController();
              
                $catController->agregarCategoria();

                break;
            case 'editar_categoria': 
                
                if (isset($params[2]) && is_numeric($params[2])) {
                    $id = $params[2];
                    $controller = new CategoriaController();
                    $controller->mostrarFormularioEditar($id); 
                } else {
                    header('Location: ' . BASE_URL . 'admin/listar');
                }
            break;

            
=======
    
>>>>>>> Stashed changes
            case 'dashboard':
            default:
                $adminController->mostrarDashboard();
                break;
        } 
         break; // 'case admin:'
    
            default:
            header('Location: ' . BASE_URL . 'productos');
            break;
        
} 
?>
       