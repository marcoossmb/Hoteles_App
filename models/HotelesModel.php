<?php

// Uso de include_once para evitar la inclusión múltiple
include_once 'db/DB.php';

class HotelesModel {

    // Obtiene una instancia de PDO para conectarse a la base de datos
    private $bd;
    private $pdo;

    public function __construct() {
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    // Recupera la lista de hoteles
    public function getHoteles() {
        // Ejecuta una consulta para recuperar todos los hoteles
        $stmt = $this->pdo->prepare('SELECT * FROM hoteles');
        $stmt->execute();

        $hoteles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel($row['id'], $row['nombre'], $row['direccion'], $row['ciudad'], $row['pais'], $row['num_habitaciones'], $row['descripcion'], $row['foto']);
        }
        return $hoteles;
    }

    public function getDetalles() {

        // Consulta para sacar los hoteles ysus respectivas habitaciones
        $sql = "SELECT h.*, hab.* FROM habitaciones hab JOIN hoteles h ON hab.id_hotel = h.id WHERE h.id = :hotel_id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hotel_id', $_GET["hotel"], PDO::PARAM_INT);
        $stmt->execute();

        $habitacionDetalle = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $habitacionDetalle[] = new Habitacion($row['id'], $row['id_hotel'], $row['num_habitacion'], $row['tipo'], $row['precio'], $row['descripcion']);
        }

        if (empty($habitacionDetalle)) {
            header("Location: ./index.php?controller=Hoteles&action=mostrarNoDisponible");
        }

        // Obtener detalles del hotel
        $stmt2 = $this->pdo->prepare('SELECT * FROM hoteles WHERE id = :hotel_id');
        $stmt2->bindParam(':hotel_id', $_GET["hotel"], PDO::PARAM_INT);
        $stmt2->execute();

        $hoteles = [];
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel($row2['id'], $row2['nombre'], $row2['direccion'], $row2['ciudad'], $row2['pais'], $row2['num_habitaciones'], $row2['descripcion'], $row2['foto']);
        }

        return array("habitacionDetalle" => $habitacionDetalle, "hoteles" => $hoteles);
    }
}
