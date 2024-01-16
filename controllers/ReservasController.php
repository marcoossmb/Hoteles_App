<?php

class ReservasController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReservasModel();
        $this->view = new ReservasView();
    }

    public function mostrar() {
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        
        if ($_SESSION["rol"] == 0) {
            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        }

        $reservas = $this->model->getReservas();

        $this->view->mostrarReservas($reservas);
    }
    
    public function reservarHabitacion() {
        session_start();
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        
        if ($_SESSION["rol"] == 1) {
            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        }
        
        $this->model->postReservas();
        
    }  
}
