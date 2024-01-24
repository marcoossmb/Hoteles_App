<?php

class HotelesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HotelesModel();
        $this->view = new HotelesView();
    }

    // Muestra la lista de hoteles si el usuario está autenticado, redirige a la página de inicio de sesión si no lo está.
    public function mostrar() {
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        $hoteles = $this->model->getHoteles();
        $this->view->mostrarHoteles($hoteles);
    }   
    
    // Muestra una página indicando que la opción no está disponible si el usuario está autenticado, redirige a la página de inicio de sesión si no lo está.
    public function mostrarNoDisponible() {
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        $this->view->mostrarNoDisponible();
    }
}