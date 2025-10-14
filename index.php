<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    
    <?php require_once 'config.php' ?>
    <?php require_once 'MVC/controllers/CategoriaController.php' ?>
    <!-- tengo que poner el header explicito hasta que aprendamos a usar los templades
        pq me parece que tenemos que usar algun freamword -->
    <header>
    <div>
        <h1>
            NUTRIPOINT
        </h1>
    </div>  

    <div>
        <ul> 
            <?php
               $mostrar = new CategoriaController();
               $mostrar->mostrarCategorias();
            ?>
        </ul>
    </div>
    <div>
        <p>inciar sesion</p> 
        <p>registro</p>
    </div>
    
    </header>
    
    <main>
        <div>
            <img src="../css/images/test-img.jpg" alt="imagen">
            <h1>aca va el nombre del producto</h1>
            <p>aca va la descripcion</p>
            <button>comprar</button>
        </div>
        </a>
          
    </main>

    <footer>

        <h2>
            aca va el footer
        </h2>

    </footer>
</body>
</html>