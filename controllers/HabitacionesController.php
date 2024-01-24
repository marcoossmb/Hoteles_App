<?php

class HabitacionesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HabitacionesModel();
        $this->view = new HabitacionesView();
    }

    /**
     * Muestra los detalles de las habitaciones de un hotel específico.
     * Redirige a la página de inicio de sesión si no está autenticado.
     * Redirige a la página de hoteles si no se proporciona un ID de hotel.
     */
    public function detalles() {
                
        session_start();
        // Redirige a la página de inicio de sesión si no está autenticado
        if (!$_SESSION["nombre"]) {
            header("Location: ./index.php?controller=Login&action=mostrar");
        }
        
        // Redirige a la página de hoteles si no se proporciona un ID de hotel
        if (!$_GET["hotel"]) {
            header("Location: ./index.php?controller=Hoteles&action=mostrar");
        }

        // Obtiene los detalles de las habitaciones del hotel desde el modelo
        $detalles = $this->model->getDetalles();

        // Muestra los detalles de las habitaciones utilizando la vista
        $this->view->mostrarDetalles($detalles);
    }    
}