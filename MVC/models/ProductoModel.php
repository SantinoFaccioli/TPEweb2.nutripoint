<?php
    class ProductoModel{
        private $db ;

        function __construct(){
            
            $this->db = new PDO( "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);

        }

        function getProductoByCatID($cat_id){
           try{
                $query = $this->db->prepare('SELECT nombre ,precio ,descripcion,imagen_producto FROM productos WHERE id_categoria = :cat_id');
                $query->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
                $query->execute();
                return $query->fetchAll(PDO::FETCH_ASSOC);
                
            }catch (PDOException $e) {
                // En caso de error de base de datos
                error_log("Error al consultar productos por categoría: " . $e->getMessage());
                return [];
            }


            

        }
    }