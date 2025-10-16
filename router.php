<?php 
require_once 'config.php'; 
require_once 'mvc/models/DBConnect.php'; 
require_once 'mvc/models/ProductoModels.php'; 
require_once 'mvc/models/CategoriaModels.php'; 
require_once 'mvc/views/viewpadre.php'; 
require_once 'MVC/controllers/CategoriaController.php'; 
require_once 'MVC/controllers/ProductoController.php'; 
require_once 'MVC/controllers/AdminController.php'; 

//  Se eliminó la definición de BASE_URL de aquí, 
// ya que se carga de config.php para evitar errores de duplicidad.
$action = $_GET['action'] ?? 'productos'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
};

$params = explode('/', $action);
$controllerName = $params[0]; // La primera parte es el nombre del controlador (Ej: productos)
$actionName = $params[1] ?? 'index'; // La segunda parte es la acción (Ej: detalle), por defecto 'index'

switch ($controllerName) {
    case 'productos':
        // RUTA /productos
        $controller = new ProductoController();
        break;

    case 'productos_cat': // Requisito: Listado de ítems por categoría
        // RUTA /productos_cat/ID
        $controller = new ProductoController();
        // La acción se llama igual, pero el parámetro será el ID de la categoría.
        // NOTA: Santino debe asegurarse de que el ProductoController sepa manejar este caso.
        break;
        
    case 'categorias':
        $controller = new CategoriaController();
        break;

    case 'admin':
    case 'login':
    case 'logout':
        // RUTA /admin o /login (Tu Rol)
       // $controller = new AdminController();
        // Ajustamos la acción si la URL es /login o /logout (por ejemplo, AdminController->login())
       // $actionName = ($controllerName === 'login' || $controllerName === 'logout') ? $controllerName : $actionName;
       // break;

   // default:
        // Si no se reconoce la ruta, redirigimos a la página principal /productos
        header('Location: ' . BASE_URL . 'productos');
        return;
}


$paramsRestantes = array_slice($params, 2);


if (method_exists($controller, $actionName)) {
    call_user_func_array([$controller, $actionName], $paramsRestantes);
} else {
    header('Location: ' . BASE_URL . 'productos'); 
}
