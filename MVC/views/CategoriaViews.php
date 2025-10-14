<?php 
    

    class CategoriaViews extends view_padre {
        function mostrarCategorias($categorias){

            foreach ($categorias as $categoria){
                echo '<li>';
                echo '<a href="http://localhost/nutripoint1.0/TPEweb2.nutripoint/index.php?cat_id=' . htmlspecialchars($categoria['id']) . '">';
                echo htmlspecialchars($categoria['nombre']);
                echo '</a>';
                echo '</li>';
            }
        }
    }