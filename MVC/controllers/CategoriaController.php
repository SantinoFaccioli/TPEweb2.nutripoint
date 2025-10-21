<?php 
    require_once __DIR__ .'/../views/BaseViews.php';
    require_once __DIR__ . '/../models/CategoriaModels.php';
    require_once __DIR__ . '/../views/CategoriaViews.php';
     require_once __DIR__ . '/../views/AdminViews.php';
    
    
    class CategoriaController {
        private $model;
        private $views;
        private $adminViews;
        
        function __construct(){
           $this->model = new ListadoCategorias();
            $this->views = new CategoriaViews();
            $this->adminViews = new AdminViews () ;
        }

        function mostrarCategorias (){
           $categorias = $this->model->getAllCategorias();

           $this->views->mostrarCategorias($categorias);
        }

        function adminListarCategorias(){
            $categorias = $this->model->getAllCategorias();

            $this->adminViews->listarCategorias($categorias);
        }

        function eliminarCategoria($cat_id){
            //$this->model->eliminarCat($cat_id);

            if (empty($cat_id) || !is_numeric($cat_id)) {
           
                $this->adminViews->mostrarError("Error: ID de categoría no especificado o inválido.");
                return;
            }
            $this->model->eliminarCat($cat_id);
            header('Location: ' . BASE_URL . 'admin/categorias');
        }
        
        
        function mostrarFormAgregar(){
            $this->adminViews->mostrarFormAddCat();
        }
        
        
        function agregarCategoria(){

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                $nombre = $_POST['nombre'] ?? null;
                $img_url = $_POST['img_url'] ?? null;
                
                    if (empty($nombre)) {
                        $this->adminViews->mostrarFormAddCat(null, "El nombre no puede estar vacío."); 
                        return;
                    }
                        $exito = $this->model->insertarCategoria($nombre, $img_url);         
                
                    if ($exito) {
                        header('Location: ' . BASE_URL . 'admin/categorias');
                    } else {
                        
                        $this->adminViews->mostrarError("Error al guardar la categoría en la base de datos.");
                    }
                            
            } else {

                $this->adminViews->mostrarFormAddCat();
            }
        }

        public function mostrarFormularioEditar($id) {
    
    // Asumimos que el Router ya validó que $id es numérico y existe
    
    // 1. VERIFICAR EL MÉTODO HTTP
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // --- LÓGICA POST: PROCESAR ACTUALIZACIÓN ---
        
        $nombre = $_POST['nombre'] ?? null;
        $img_url = $_POST['img_url'] ?? null;
        
        if (empty($nombre)) {
          /*  $categoria = $this->model->obtenerCatPorID($id); 
            $this->adminViews->mostrarFormularioEditar($categoria, BASE_URL . 'admin/editar_categoria/' . $id, "El nombre no puede estar vacío.");
            return;*/

            
    // 1. Crear un objeto temporal con los datos ENVIADOS por el usuario.
    $datos_enviados = new stdClass();
    $datos_enviados->id = $id; // Mantenemos el ID
    $datos_enviados->nombre = $nombre; // Usamos el nombre que EL USUARIO ENVIÓ (que está vacío)
    $datos_enviados->imagen_categoria = $img_url; // Usamos la URL que EL USUARIO ENVIÓ

    // 2. Llamar a la Vista con el objeto que contiene los datos del POST
    $action_url = BASE_URL . 'admin/editar_categoria/' . $id;
    $this->adminViews->mostrarFormularioEditar($datos_enviados, $action_url, "El nombre no puede estar vacío.");
        }

        // Llamada al Modelo para actualizar
        $exito = $this->model->actualizarCategoria($id, $nombre, $img_url); 
        
        if ($exito) {
            // Éxito: Redirigir al listado (Patrón PRG)
            header('Location: ' . BASE_URL . 'admin/listar');
        } else {
            // Fallo de DB: Mostrar error
            $this->adminViews->mostrarError("Error al actualizar en la base de datos.");
        }
        exit;
        
    } else {
        
        // --- LÓGICA GET: MOSTRAR FORMULARIO PRECARGADO ---
        
        $categoria = $this->model->obtenerCatPorID($id);
        
        if (!$categoria) {
            header("HTTP/1.0 404 Not Found");
            $this->adminViews->mostrarError("Error 404: Categoría no encontrada.");
            return;
        }
        
        $action_url = BASE_URL . 'admin/editar_categoria/' . $id; 
        
        // Llama a la vista para que pinte el formulario con datos
    
        $this->adminViews->mostrarFormEditCat($categoria, $action_url); 
    }
}
    }
