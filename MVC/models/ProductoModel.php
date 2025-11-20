<?php
class ProductoModel{
    private $db ;

    function __construct(){
        $this->db = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

        function obtenerTodosProductos(){
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
                /* p.imagen_producto, */
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
                /* p.imagen_producto, */
                p.id_producto,
                p.id_categoria,
                p.stock,
                c.nombre AS nombre_categoria,  
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
