<?php
class ProductoModel{
    private $db ;

    function __construct(){
        $this->db = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function obtenerTodosProductosConCategoria() {
        $query = $this->db->prepare("
            SELECT p.*, c.nombre AS nombre_categoria 
            FROM productos p
            LEFT JOIN categoria c ON p.id_categoria = c.id
        ");
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function obtenerProductoPorIdConCategoria($id_producto) {
        $query = $this->db->prepare("
            SELECT p.*, c.nombre AS nombre_categoria 
            FROM productos p
            LEFT JOIN categoria c ON p.id_categoria = c.id
            WHERE p.id_producto = ?
        ");
        $query->execute([$id_producto]);
        
        return $query->fetch(PDO::FETCH_ASSOC); 
    }


    // gordo::(
    // coso me dijo esto, te lo dejo por si queres chusmearlo, capaz esta mal asi que no toque nada tuyo
    // 1. El TPE pide que *siempre* se muestre el nombre de la categoría (Tarea 3). 
    //    Deberías agregar un JOIN como en las funciones de Rol A.
    // 2. Tu SELECT busca 'imagen_producto', pero el SQL ('db_nutripoint.sql') 
    //    no tiene esa columna en la tabla 'productos'. Esto puede fallar.
    function getProductoByCatID($cat_id){
       try{
            $query = $this->db->prepare('SELECT nombre ,precio ,descripcion,imagen_producto FROM productos WHERE id_categoria = :cat_id');
            $query->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // <-- Esto ya estaba bien (usaba Arrays)
            
       }catch (PDOException $e) {
            error_log("Error al consultar productos por categoría: " . $e->getMessage());
            return [];
       }
    }
    
    public function insertProduct($nombre, $descripcion, $precio, $id_categoria, $stock = 0) {
        $query = $this->db->prepare("
            INSERT INTO productos (nombre, descripcion, precio, id_categoria, stock) 
            VALUES (?, ?, ?, ?, ?) 
        ");
        $query->execute([$nombre, $descripcion, $precio, $id_categoria, $stock]);
        return $this->db->lastInsertId();
    }
    public function updateProduct($id, $nombre, $descripcion, $precio, $id_categoria, $stock) {
        $query = $this->db->prepare("
            UPDATE productos 
            SET nombre = ?, descripcion = ?, precio = ?, id_categoria = ?, stock = ?
            WHERE id_producto = ?
        ");
        $query->execute([$nombre, $descripcion, $precio, $id_categoria, $stock, $id]);
    }
    public function deleteProduct($id) {
        $query = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
        $query->execute([$id]);
    }
}