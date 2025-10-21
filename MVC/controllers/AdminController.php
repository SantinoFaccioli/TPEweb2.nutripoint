<?php
require_once __DIR__ .'/../views/AdminViews.php';

class AdminController {

    private $view;

    public function __construct() {
        $this->iniciarSesionSiNoEstaIniciada();
        $this->view = new AdminViews();
    }

    private function iniciarSesionSiNoEstaIniciada() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function mostrarLogin() {
        $this->view->mostrarLogin();
    }
    public function validar() {
        $usuario = $_POST['usuario'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($usuario === ADMIN_USER && $password === ADMIN_PASS) {
            $_SESSION['IS_LOGGED'] = true;
            $_SESSION['USERNAME'] = $usuario;

            header('Location: ' . BASE_URL . 'admin/dashboard');
        } else {

            $this->view->mostrarLogin("Usuario o contraseña incorrectos.");
        }
    }
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }
    public function checkLogin() {
        if (!isset($_SESSION['IS_LOGGED']) || $_SESSION['IS_LOGGED'] !== true) {
            header('Location: ' . BASE_URL . 'login');
            die(); 
        }
    }
    public function mostrarDashboard() {
        $this->view->mostrarDashboard();
    }
}