<?php
require_once __DIR__ .'/../views/productoViews.php'; 
require_once __DIR__ .'/../views/AdminViews.php'; 
require_once __DIR__ .'/../models/ProductoModel.php';
require_once __DIR__ .'/../models/CategoriaModels.php'; 

class ProductoController {
    private $productoModel;
    private $categoriaModel; 
    private $view; 
    private $adminView; 

    public function __construct() {
        $this->productoModel = new ProductoModel(); 
        $this->categoriaModel = new ListadoCategorias(); 
        $this->view = new productoViews(); 
        $this->adminView = new AdminViews(); 
    }

    public function verTodos() {
        $productos = $this->productoModel->obtenerTodosProductos();
        $this->view->mostrarTodosProductos($productos);
    }

    public function detalle($id) {
        $producto = $this->productoModel->obtenerProductoPorId($id);
        
        if (!empty($producto)) {
            $this->view->mostrarDetalleProducto($producto);
        } else {
            $this->view->mostrarError("Error 404: Producto no encontrado.");
        }
    }
    public function mostrarProductosXCategoria($cat_id){
        if (empty($cat_id) || !is_numeric($cat_id)) {
            echo('error');
            die();
        } 
        $productos = $this->productoModel->getProductoByCatID($cat_id);
        $this->view->mostrarProductosByCatID($productos); 
    }
    public function adminListarProductos() {
        $productos = $this->productoModel->obtenerTodosProductos(); 
        
        $categorias = $this->categoriaModel->getAllCategorias(); 
        $this->adminView->mostrarAdminProductos($productos, $categorias); 
    }
    public function adminAgregarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $stock = $_POST['stock'] ?? 0;
            $id_categoria = $_POST['id_categoria'] ?? null;

            if (empty($nombre) || empty($precio) || empty($id_categoria)) {
                echo "Error: Faltan datos obligatorios.";
                die();
            }

            // $imagen_url = $_POST['imagen_producto'] ?? ''; NO hay imagen en sql hay q agregar
            $this->productoModel->insertProduct($nombre, $descripcion, $precio, $id_categoria, $stock);
            header('Location: ' . BASE_URL . 'admin/productos');
            
        } else {
            header('Location: ' . BASE_URL . 'admin/productos');
        }
    }
    
    public function adminEliminarProducto($id) {
        if ($id > 0) {
            $this->productoModel->deleteProduct($id);
        }

        header('Location: ' . BASE_URL . 'admin/productos');
    }
 public function adminMostrarFormularioEditar($id) {
        $producto = $this->productoModel->obtenerProductoPorId($id);

        $categorias = $this->categoriaModel->getAllCategorias();
        
        if ($producto && $categorias) {
            $this->adminView->mostrarFormularioEditar($producto, $categorias); 
        } else {
            $this->adminView->mostrarError("Error: No se pudo encontrar el producto."); 
        }
    }
    public function adminProcesarEdicion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'] ?? 0;
            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $stock = $_POST['stock'] ?? 0;
            $id_categoria = $_POST['id_categoria'] ?? null;

            // 2. Validación
            if (empty($nombre) || empty($precio) || empty($id_categoria) || $id_producto == 0) {
                echo "Error: Faltan datos obligatorios o el ID es inválido.";
                die();
            }
            $this->productoModel->updateProduct($id_producto, $nombre, $descripcion, $precio, $id_categoria, $stock);

            header('Location: ' . BASE_URL . 'admin/productos');
            
        } else {
            header('Location: ' . BASE_URL . 'admin/productos');
        }
    }
}

