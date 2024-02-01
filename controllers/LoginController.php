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
        $pass = hash("sha256", $_POST['contrasena']);

        $usuarioLogin = $this->model->comprobarUsuario($user, $pass);

        if ($usuarioLogin) {

            // Se obtiene la fecha actual
            $fecha = date('d-m-Y H:i:s');
            setcookie("lastconexion", $fecha, time() + 20 * 24 * 3600, "/");

            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        } else {
            header("Location: ./index.php?errorLog=true");
        }
    }

    // Función para cerrar sesión
    public function cerrarSesion() {
        session_start();

        //Borramos las sesiones existentes
        $_SESSION = array();
        session_destroy();
        setcookie("lastconexion", "", time() - 1);

        //Redireccionamiento
        header('Location: ./index.php');
    }
}