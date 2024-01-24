<?php

class ReservasController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReservasModel();
        $this->view = new ReservasView();
    }

    /**
     * Muestra las reservas si el usuario está autenticado y tiene el rol adecuado.
     * Redirige a la página de inicio de sesión si no está autenticado.
     * Redirige a la página de hoteles si el rol no es el correcto.
     */
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
    
    /**
     * Realiza la reserva de una habitación si el usuario está autenticado y tiene el rol adecuado.
     * Redirige a la página de inicio de sesión si no está autenticado.
     * Redirige a la página de hoteles si el rol no es el correcto.
     */
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
    
    /**
     * Muestra los detalles de una reserva si el usuario está autenticado y tiene el rol adecuado.
     * Redirige a la página de inicio de sesión si no está autenticado.
     * Redirige a la página de hoteles si el rol no es el correcto.
     */
    public function mostrardetalles() {
        session_start();

        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        
        if ($_SESSION["rol"] == 0) {
            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        }

        $detareservas = $this->model->getReservasDetalle();
        
        $this->view->detallesReserva($detareservas);
    }
    
    /**
     * Muestra una página indicando que la opción no está disponible si el usuario está autenticado y tiene el rol adecuado.
     * Redirige a la página de inicio de sesión si no está autenticado.
     * Redirige a la página de hoteles si el rol no es el correcto.
     */
    public function mostrarNoDisponible() {
        session_start();

        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }

        if ($_SESSION["rol"] == 0) {
            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        }
        
        $this->view->mostrarNoDisponible();
    }
}