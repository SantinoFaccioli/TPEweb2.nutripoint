<?php
    class productoViews extends view_padre{
        
        function mostrarProductosByCatID($productos,$categorias){
           parent::header($categorias);
           
            foreach($productos as $producto){
                parent::cardProducto($producto['nombre'],$producto['precio'],$producto['descripcion'],$producto['imagen_producto']);
            }

            parent::footer();
        }
    }