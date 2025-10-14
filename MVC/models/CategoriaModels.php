<?php 

    class ListadoCategorias {
        private $db;

       function __construct(){
          $this->db = new PDO('mysql:host=localhost;dbname=nutripoint_bd;charset=utf8', 'root', '');
       }

       public function getAllCategorias(){
        $query = $this->db->prepare('SELECT nombre , id FROM categoria');
        $query -> execute();
        $rta =$query->fetchAll((PDO::FETCH_ASSOC));

        return $rta;
       }
    }