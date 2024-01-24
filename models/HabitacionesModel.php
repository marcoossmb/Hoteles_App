<?php

// Utiliza include_once para evitar la inclusión múltiple de la clase DB
include_once 'db/DB.php';

class HabitacionesModel {

    // Propiedades para la conexión a la base de datos
    private $bd;
    private $pdo;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct() {
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Obtiene detalles de habitaciones y del hotel correspondiente.
     * Redirige a la página de hoteles si no hay habitaciones disponibles.
     */
    public function getDetalles() {
        // Consulta SQL para obtener habitaciones y detalles del hotel
        $sql = "SELECT h.*, hab.* FROM habitaciones hab JOIN hoteles h ON hab.id_hotel = h.id WHERE h.id = :hotel_id;";

        // Prepara y ejecuta la consulta SQL
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hotel_id', $_GET["hotel"], PDO::PARAM_INT);
        $stmt->execute();

        // Inicializa un array para almacenar objetos Habitacion
        $habitacionDetalle = [];

        // Recorre los resultados y crea objetos Habitacion con la información obtenida
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $habitacionDetalle[] = new Habitacion($row['id'], $row['id_hotel'], $row['num_habitacion'], $row['tipo'], $row['precio'], $row['descripcion']);
        }

        // Redirige a la página de hoteles si no hay habitaciones disponibles
        if (empty($habitacionDetalle)) {
            header("Location: ./index.php?controller=Hoteles&action=mostrarNoDisponible");
        }

        // Obtiene detalles adicionales del hotel
        $stmt2 = $this->pdo->prepare('SELECT * FROM hoteles WHERE id = :hotel_id');
        $stmt2->bindParam(':hotel_id', $_GET["hotel"], PDO::PARAM_INT);
        $stmt2->execute();

        // Inicializa un array para almacenar objetos Hotel
        $hoteles = [];

        // Recorre los resultados y crea objetos Hotel con la información obtenida
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel($row2['id'], $row2['nombre'], $row2['direccion'], $row2['ciudad'], $row2['pais'], $row2['num_habitaciones'], $row2['descripcion'], $row2['foto']);
        }

        // Retorna un array con las habitaciones y detalles del hotel
        return array("habitacionDetalle" => $habitacionDetalle, "hoteles" => $hoteles);
    }
}