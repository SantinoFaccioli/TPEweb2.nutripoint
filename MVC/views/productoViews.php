<?php
    class productoViews extends BaseViews{
        
        function mostrarProductosByCatID($productos){
           parent::header();
           
            foreach($productos as $producto){
                
                parent::cardProducto($producto['nombre'],$producto['precio'],$producto['descripcion'],$producto['imagen_producto']);
            }

            parent::footer();
        }

        /* esto lo hago para que se vea bonito el home aca deberias hacer el ver todos los productos :) <3 */

        function verTodosProductos(){
            parent::header();
            echo'<h1>aca van todos los productos XD</h1>';
            parent::footer();
        }
    }