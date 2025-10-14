<?php

// RESPONSABILIDAD: Recibe peticiones del Router y decide qué Modelo usar y qué Vista mostrar.

// Trae la clase View (para armar las plantillas HTML)
require_once 'mvc/helpers/View.php';
// Trae la clase ProductoModel (para acceder a la Base de Datos)
require_once 'mvc/models/Producto.php'; 
require_once 'mvc/models/Categoria.php'; // Modelo usuarioB para usar en el ABM

class ProductoController {
    private $productoModel; //es para q no se puedan modificar por el de afuera por eso priv
    private $view;

    public function __construct() {
        
        // Inicializa el Modelo, la herramienta para obtener datos (almacén)
        $this->productoModel = new ProductoModel(); 
        
       
        $this->view = new View(); 
    }

    /**
     * Muestra el listado de productos de la página principal .
     */
    public function index() {
        // 1. LÓGICA: Le pide los datos al Modelo (VA A LA BASE DE DATOS)
        $productos = $this->productoModel->obtenerTodosProductos();

        // 2. VISTA: Ensambla la página final. Le pasa la lista ($productos) a la plantilla index.phtml.
        $this->view->show('productos/index', [
            'productos' => $productos 
        ]);
    }

    /**
     
     * Muestra un único producto (/productos/detalle/ID) (Requisito: Detalle de ítem).
     */
    public function detalle($id) {
        // 1. LÓGICA: Pide un producto específico por ID
        $producto = $this->productoModel->obtenerProductoPorId($id);

        if ($producto) {
            // 2. VISTA: Si lo encuentra, muestra la plantilla detalle.phtml
            $this->view->show('productos/detalle', [
                'producto' => $producto
            ]);
        } else {
            // Maneja el error si el ID no existe (Buena práctica: 404 Not Found)
            header("HTTP/1.0 404 Not Found");
            echo "<h1>Error 404: Producto no encontrado en NutriPoint.</h1>";
        }
    }
    
    // Aquí se agregarán las funciones del ABM (Rol A) para la administración.
}
