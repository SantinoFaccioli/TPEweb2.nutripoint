<?php 
define('DB_HOST', 'localhost');
define('DB_NAME', 'nutripoint_bd');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
// Define las credenciales del administrador 
define('ADMIN_USER', 'webadmin');
define('ADMIN_PASS', 'admin'); // NOTA: En la realidad, esto debería ser un hash.
?>