<?php 
    
    require_once __DIR__ . '/../models/CategoriaModels.php';
    require_once __DIR__ . '/../views/CategoriaViews.php';
    
    
    class CategoriaController {
        private $model;
        private $views;
        
        function __construct(){
           $this->model = new ListadoCategorias();
            $this->views = new CategoriaViews();
        }

        function mostrarCategorias (){
           $categorias = $this->model->getAllCategorias();

           $this->views->mostrarCategorias($categorias);
        }
    }
