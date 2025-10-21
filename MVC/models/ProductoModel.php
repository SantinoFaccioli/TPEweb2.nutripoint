<?php
class ProductoModel{
    private $db ;

    function __construct(){
        $this->db = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // gordo::(
    // coso me dijo esto, te lo dejo por si queres chusmearlo, capaz esta mal asi que no toque nada tuyo
    // 1. El TPE pide que *siempre* se muestre el nombre de la categoría (Tarea 3). 
    //    Deberías agregar un JOIN como en las funciones de Rol A.
    // 2. Tu SELECT busca 'imagen_producto', pero el SQL ('db_nutripoint.sql') 
    //    no tiene esa columna en la tabla 'productos'. Esto puede fallar.


        
        function obtenerTodosProductos(){
            $query = $this->db->prepare('SELECT p.nombre, 
                p.precio, 
                p.descripcion, 
                p.imagen_producto, 
                p.id_producto,
                c.nombre AS nombre_categoria,  /* Alias para el nombre de la categoría */
                c.id                /* ID de la categoría */
            FROM productos p                   /* Alias de la tabla de productos */
            JOIN categoria c ON p.id_categoria = c.id  /* Unir donde los IDs coinciden */
            ORDER BY p.id_producto ASC
        ');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getProductoByCatID($cat_id){
           try{
                $query = $this->db->prepare('SELECT p.nombre, 
                p.precio, 
                p.descripcion, 
                p.imagen_producto, 
                p.id_producto,
                c.nombre AS nombre_categoria,  /* Alias para el nombre de la categoría */
                c.id                /* ID de la categoría */
            FROM productos p                   /* Alias de la tabla de productos */
            JOIN categoria c ON p.id_categoria = c.id  /* Unir donde los IDs coinciden */
            WHERE id_categoria = :cat_id
            ORDER BY p.id_producto ASC
         ');
                $query->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
                
            }catch (PDOException $e) {
                // En caso de error de base de datos
                error_log("Error al consultar productos por categoría: " . $e->getMessage());
                return [];
            }
        }

        function obtenerProductoPorId($producto_id){
            try{
                $query = $this->db->prepare('SELECT p.nombre, 
                p.precio, 
                p.descripcion, 
                p.imagen_producto, 
                p.id_producto,
                p.stock,
                c.nombre AS nombre_categoria,  /* Alias para el nombre de la categoría */
                c.id                /* ID de la categoría */
                FROM productos p                   /* Alias de la tabla de productos */
                JOIN categoria c ON p.id_categoria = c.id  /* Unir donde los IDs coinciden */
                WHERE p.id_producto = :producto_id
                ORDER BY p.id_producto ASC');


                $query->bindParam(':producto_id',$producto_id,PDO::PARAM_INT);
                $query ->execute();
                return $query->fetch(PDO::FETCH_OBJ);
            }catch(PDOException $e) {
                // En caso de error de base de datos
                error_log("Error al consultar producto : " . $e->getMessage());
                return [];
            }
        }

            
        /* estos son las funciones que agregue haciendo lo de que se ve la categoria a lo que agregaste le faltan cosas pero supongo que se las vas a agregar despues 
        si vas a usar PDO::FETCH_OBJ (el que se escribe con flechitas) usalo en todo lo mismo si vamos a usar el array assoc elegimos uno pero usamos ese solamente fijate cual te gusta  mas
        y si agregas o sacas cosas POR FAVOR FIJATE QUE FUNCIONE NO SUBAS COSAS SIN PROBAR!!!!
        
        con respecto a los de las imagenes lo puse pq yo en mi db tengo imagenes en ambas tablas*/
        
   
    
     function insertProduct($nombre, $descripcion, $precio, $id_categoria, $stock = 0) {
        $query = $this->db->prepare("
            INSERT INTO productos (nombre, descripcion, precio, id_categoria, stock) 
            VALUES (?, ?, ?, ?, ?) 
        ");
        $query->execute([$nombre, $descripcion, $precio, $id_categoria, $stock]);
        return $this->db->lastInsertId();
    }
     function updateProduct($id, $nombre, $descripcion, $precio, $id_categoria, $stock) {
        $query = $this->db->prepare("
            UPDATE productos 
            SET nombre = ?, descripcion = ?, precio = ?, id_categoria = ?, stock = ?
            WHERE id_producto = ?
        ");
        $query->execute([$nombre, $descripcion, $precio, $id_categoria, $stock, $id]);
    }
     function deleteProduct($id) {
        $query = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
        $query->execute([$id]);
    }
}
