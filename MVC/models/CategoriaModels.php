<?php 

    class ListadoCategorias {
        private $db;

       function __construct(){
          $this->db = new PDO('mysql:host=localhost;dbname=nutripoint_bd;charset=utf8', 'root', '');
       }
       public function obtenerCatPorID($id){
         try {
            $query= $this->db->prepare('SELECT nombre , id ,imagen_categoria FROM categoria WHERE id = :id ');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query -> execute();
            $rta = $query -> fetch(PDO::FETCH_OBJ);

            return $rta ?: null;
         } catch (PDOException $e) {
            error_log("No se encontro la categoría con ID {$id}: " . $e->getMessage());
         }
       }
       public function getAllCategorias(){
        $query = $this->db->prepare('SELECT nombre , id ,imagen_categoria FROM categoria');
        $query -> execute();
        $rta =$query->fetchAll((PDO::FETCH_ASSOC));

        return $rta;
       }

       function eliminarCat($cat_id){
         try {
             $query = $this->db->prepare('DELETE FROM categoria WHERE id = :cat_id');
            $query->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
            $query ->execute();
         } catch (PDOException $e) {
            error_log("Error al eliminar categoría con ID {$cat_id}: " . $e->getMessage());
               return false;
         }
      }
      public function insertarCategoria($nombre, $img_url) { 
    try {
        $query = $this->db->prepare("INSERT INTO categoria (nombre, imagen_categoria) VALUES (?, ?)");
        $query->bindParam(1, $nombre, PDO::PARAM_STR); 
        $query->bindParam(2, $img_url, PDO::PARAM_STR); 
        $query->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Error al insertar categoría: " . $e->getMessage());
        return false;
    }
   }

   public function actualizarCategoria($id, $nombre, $img_url) {
   // try {
        
        $query = $this->db->prepare("UPDATE categoria SET nombre = ?, imagen_categoria = ? WHERE id = ?");
        
       
        $query->bindParam(1, $nombre, PDO::PARAM_STR);
        $query->bindParam(2, $img_url, PDO::PARAM_STR);
        $query->bindParam(3, $id, PDO::PARAM_INT); 
        
        $query->execute();


        /*} catch (PDOException $e) {
        error_log("Error al actualizar categoría (ID: {$id}): " . $e->getMessage());
        
        return false;*/

        try {
        // ... (código de prepare y bindParam) ...
        $query->execute();
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        // 🚨 HAZ ESTO SÓLO TEMPORALMENTE PARA VER EL MENSAJE SQL
        // Muestra el error exacto que la base de datos está enviando
        throw $e; 
        
        return false;
    }
   //}
    
   }   

    }