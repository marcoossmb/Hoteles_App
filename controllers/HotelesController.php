<?php

class HotelesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HotelesModel();
        $this->view = new HotelesView();
    }

    public function mostrar() {
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }

        $hoteles = $this->model->getHoteles();

        $this->view->mostrarHoteles($hoteles);
    }   
    
    public function mostrarNoDisponible() {
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }

        $this->view->mostrarNoDisponible();
    }
}
