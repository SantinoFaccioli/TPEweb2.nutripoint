<?php 
    

    class CategoriaViews extends BaseViews {
        function mostrarCategorias($categorias){

            parent::header();


            foreach ($categorias as $categoria){
             
                echo '<div>';
                echo '<img src='.$categoria['imagen_categoria']. 'alt="imagen">';
                echo '<h1>';
                    echo '<a href="' . BASE_URL . 'productos_cat/' . htmlspecialchars($categoria['id']) . '">';
                        echo htmlspecialchars($categoria['nombre']);
                    echo '</a>';
                echo'</h1>';
                
                echo' <button>ver productos</button>
                </div>';
            }

            parent::footer();
        }
        
    }