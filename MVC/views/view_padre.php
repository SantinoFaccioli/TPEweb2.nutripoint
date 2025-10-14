<?php 
    class view_padre{

        function header ($categorias){
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="css/style.css">
                <title> - NUTRIPOINT</title>
            </head>
            <body>
                <header>
                    <div>
                        <h1>NUTRIPOINT</h1>
                    </div>'; 
                    
            // --- Menú de Categorías ---
            echo '<div>
                <nav><ul>'; 
                    
            // Iteramos sobre las categorías (asumimos que son arrays asociativos)
            foreach ($categorias as $categoria){
                // Usamos la constante BASE_URL definida en el router
                $url_destino = BASE_URL . '?action=productos_cat&cat_id=' . htmlspecialchars($categoria['id_categoria']);
                
                echo '<li><a href="' . $url_destino . '">' . htmlspecialchars($categoria['nombre']) . '</a></li>';
            }
            
            echo '</ul></nav>
            </div>
            <div>
                <p><a href="' . BASE_URL . '?action=login">iniciar sesion</a></p> 
                <p><a href="' . BASE_URL . '?action=register">registro</a></p>
            </div>
            </header>
            <main>'; // Abre la etiqueta <main>
        }

        function footer () {
             echo '         </main>
                        </body>
                    </html>';
        }

       protected function cardProducto($nombre,$precio,$descripcion,$img){
           echo '<div>';
           echo '<img src='.$img. 'alt="imagen">';
           echo '<h1>'.$nombre.'</h1>';
           echo '<p>'.$descripcion.'</p>';
           echo' <button>comprar</button>
        </div>';
        }

    }
    