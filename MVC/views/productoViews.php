<?php
require_once __DIR__ .'/BaseViews.php';

class productoViews extends BaseViews {
    public function mostrarTodosProductos($productos) {
        $this->header(); 
        require 'MVC/views/public/listado_productos.phtml'; 
        
        $this->footer(); 
    }

   
    public function mostrarDetalleProducto($producto) {
        $this->header();
        
        
        require 'MVC/views/public/detalle_producto.phtml';
        
        $this->footer();
    }

    public function mostrarProductosByCatID($productos) {
        $this->header();
        
        require 'MVC/views/public/listado_productos.phtml';
        
        $this->footer();
    }
    
    public function mostrarError($error) {
        $this->header();
        echo '<h1>'.htmlspecialchars($error).'</h1>';
        $this->footer();
    }
}