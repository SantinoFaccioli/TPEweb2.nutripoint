<?php
    class ProductoModel{
        private $db ;

        function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=nutripoint_bd;charset=utf8', 'root', '');

        }

        function getProductoByCatID($cat_id){
           try{
                $query = $this->db->prepare('SELECT nombre ,precio FROM productos WHERE  categoria_id = :cat_id');
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