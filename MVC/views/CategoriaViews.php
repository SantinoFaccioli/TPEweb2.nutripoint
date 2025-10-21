<?php 
    

    class CategoriaViews extends BaseViews {
        function mostrarCategorias($categorias){

            parent::header();


            foreach ($categorias as $categoria){
             
                echo '<div>';
                echo '<img src='.$categoria['imagen_categoria']. 'alt="imagen">';
                echo '<h1>';
                    echo '<a href="http://localhost/nutripoint1.0/TPEweb2.nutripoint/productos_cat/' . htmlspecialchars($categoria['id']) . '">';
                        echo htmlspecialchars($categoria['nombre']);
                    echo '</a>';
                echo'</h1>';
                
                echo' <button>ver productos</button>
                </div>';
            }

            parent::footer();
        }
        
    }