<?php
    require_once __DIR__ .'/../views/BaseViews.php';
    require_once __DIR__ .'/../models/ProductoModel.php';
    require_once __DIR__ .'/../views/productoViews.php';

    

class ProductoController {
    private $productoModel;
    private $view;
    private $categoriaModel; // Lo usaremos para el ABM (el select de categorías)

    public function __construct() {
        // Al iniciar, se prepara para el trabajo:
        // Inicializa el Modelo, la herramienta para obtener datos (el almacén)
            $this->productoModel = new ProductoModel(); 
        
        // Inicializa la Vista, la herramienta para armar la página HTML (view_padre)
        // NOTA: Si la clase en el archivo se llama 'view_padre', usamos 'view_padre' aquí.
        $this->view = new productoViews(); 
        
        // Inicializa el Modelo de Categorías (necesario para el ABM y el menú)
        //$this->categoriaModel = new CategoriaModels();
    }

    /**
     * FUNCIÓN PRINCIPAL: index()
     * Propósito: Muestra el listado de productos de la página principal (Acceso Público).
     * Ruta: /productos o / (llamado por defecto)
     */
   /* public function index() {
        // 1. LÓGICA: Pide los datos al Modelo (VA A LA BASE DE DATOS)
        $productos = $this->productoModel->obtenerTodosProductos();
        
        // 2. LÓGICA: También pedimos la lista de categorías (necesario para el menú del header)
        $categorias = $this->categoriaModel->obtenerTodasCategorias();

        // 3. VISTA: Ensambla la página final.
        // Carga la parte superior de la página (<!DOCTYPE html>, <header>, <main>)
        $this->view->header($categorias); 
        
        // Muestra el contenido principal (el código de mvc/views/productos/index.phtml)
        // Le pasamos la lista de productos para que la vista los pinte.
        require 'mvc/views/productos/index.phtml'; 
        
        // Carga la parte inferior de la página (</main>, <footer>, </body>, </html>)
        $this->view->footer(); 
    }*/

    /**
     * FUNCIÓN: detalle($id)
     * Propósito: Muestra un único producto (/productos/detalle/ID) (Acceso Público).
     */
  /*  public function detalle($id) {
        // 1. LÓGICA: Pide el producto específico y las categorías
        $producto = $this->productoModel->obtenerProductoPorId($id);
        $categorias = $this->categoriaModel->obtenerTodasCategorias(); // Para el menú

        if ($producto) {
            // 2. VISTA: Si lo encuentra, ensambla la página
            $this->view->header($categorias);
            // La vista detalle.phtml se encargará de mostrar $producto
            require 'mvc/views/productos/detalle.phtml';
            $this->view->footer();
        } else {
            // Maneja el error si el ID no existe
            header("HTTP/1.0 404 Not Found");
            $this->view->header($categorias);
            echo "<h1>Error 404: Producto no encontrado en NutriPoint.</h1>";
            $this->view->footer();
        }
    }*/

    public function mostrarProductosXCategoria($cat_id){
        
         if (empty($cat_id) || !is_numeric($cat_id)) {
             
             echo('error');
        } 
        $productos = $this->productoModel->getProductoByCatID($cat_id);
        
        // 3. Ordenar a la Vista que muestre los datos
        $this->view->mostrarProductosByCatID($productos); 
        // Nota: Podrías llamar a CategoriaModel para obtener el nombre de la cat.
    }

    function verTodos(){
        $this->view->verTodosProductos();
    }
    
    
    // Aquí irían las funciones del ABM para la administración (Rol A): 
    // adminProductos, agregarProducto, editarProducto, eliminarProducto.
}
