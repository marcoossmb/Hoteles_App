<?php

class LoginController {
    // Obtiene una instancia de la vista del login
    private $model;
    private $view;

    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new LoginView();
    }

    // Muestra el login
    public function mostrar() {

        $this->view->mostrarLogin();
    }
    
    // Procesa el login para verificar usuario
    public function procesarLogin() {
        // Recupera los datos del login
        $user = $_POST['usuario'];
        $pass = hash("sha256",$_POST['contrasena']);
        
        $usuarios = $this->model->comprobarUsuario($user, $pass);        
    }
}