<?php 
    class BaseViews{

        function header (){
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="' . BASE_URL . '/css/style.css">
                <title> - NUTRIPOINT</title>
            </head>
            <body>
                <header>
                    <div>
                        <h1>NUTRIPOINT</h1>
                    </div>'; 
                    
            // --- Menú de Categorías ---
            echo '<div>
                <nav>
                    <ul>
                
                        <li><a href="http://localhost/nutripoint1.0/TPEweb2.nutripoint/productos"> ver todos los productos </a></li>
                        <li><a href="http://localhost/nutripoint1.0/TPEweb2.nutripoint/categorias"> ver categorias </a></li>

                
                    </ul>
                </nav>
            </div>
            <div>
                <p><a href="' . BASE_URL . '/login">iniciar sesion</a></p> 
                <p><a href="' . BASE_URL . '?action=register">registro</a></p>
            </div>
            </header>
            <main>'; // Abre la etiqueta <main>
        }

        function footer () {
             echo '         </main>
                            <p> aca va el footer </p>
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

        protected function mostrarErro($error){
           
            echo '<h1>'.htmlspecialchars($error).'</h1>';
        }

    }
    