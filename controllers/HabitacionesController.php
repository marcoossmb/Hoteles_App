<?php

class HabitacionesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HabitacionesModel();
        $this->view = new HabitacionesView();
    }

    public function detalles() {
                
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        
        if (!$_GET["hotel"]) {
            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        }

        $detalles = $this->model->getDetalles();

        $this->view->mostrarDetalles($detalles);
    }    
}