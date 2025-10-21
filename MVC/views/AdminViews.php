
<?php
require_once __DIR__ .'/BaseViews.php'; 

class AdminViews extends BaseViews {
    public function mostrarLogin($error = null) {
        $this->header(); 
        require 'MVC/views/admin/login.phtml'; 
        
        if ($error) {
            echo '<div><p style="color: red;">' . htmlspecialchars($error) . '</p></div>';
        }
        
       $this->footer();
    }

    public function mostrarDashboard() {
        $this->adminHeader(); 
        
        require 'MVC/views/admin/dashboard.phtml';
        
       $this->footer();
    }

    public function mostrarAdminProductos($productos, $categorias) {
        $this->adminHeader(); 
      
        require 'admin/productos.phtml';
        
        echo '<h2>Administrar Productos</h2>';
        
        require 'MVC/views/admin/productos_tabla.phtml';  /* esto no existe XD  */

      $this->footer();
    }

    public function mostrarFormularioEditar($producto, $categorias) {
        $this->adminHeader();
        
        echo "<h2>Editando Producto: " . htmlspecialchars($producto->nombre) . "</h2>";
        
        require 'MVC/views/admin/producto_form_editar.phtml'; 

       $this->footer();
    }
    public function mostrarRegistro($error = null) {
        $this->header(); 
             require __DIR__ . '/admin/registro.phtml';
        
        if ($error) {
            echo '<div><p style="color: red;">' . htmlspecialchars($error) . '</p></div>';
        }
        
        $this->footer();
    }


    private function adminHeader() {
        require 'MVC/views/admin/admin_header.phtml';
    }
   
    public function mostrarError($error) {
        $this->adminHeader(); 
        echo '<h1>'.htmlspecialchars($error).'</h1>';
        $this->footer(); 
    }

    function listarCategorias($categorias){
        $this->adminHeader();
        require 'MVC/views/admin/categorias.phtml';
        $this->footer();
    }
    function mostrarFormAddCat(){
        $this->adminHeader();
        require 'MVC/views/admin/categoria_form_add.phtml';
        $this->footer();
    }

    public function mostrarFormEditCat($categoria, $action_url) {
    
    $this->adminHeader();

    require 'MVC/views/admin/categoria_form_edit.phtml'; 
    
    $this->footer();
}
} 