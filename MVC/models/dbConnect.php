<?php
// RESPONSABILIDAD: Establecer una conexión segura a la Base de Datos usando PDO.
class DBConnect {
    // Variable protegida que guarda la conexión a la Base de Datos. 
    // Los Modelos que hereden de esta clase podrán usarla con $this->db.
    protected $db;

    public function __construct() {
        
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';

        try {
    
            $this->db = new PDO($dsn, DB_USER, DB_PASS);
            
            // 3. Configuración: Le dice a PDO que lance excepciones en caso de errores de SQL.
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Error de conexión a la Base de Datos: " . $e->getMessage());
        }
    }
}