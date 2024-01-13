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
        $stmt = $this->pdo->prepare('SELECT * FROM habitaciones WHERE id_hotel = ' . $_GET["hotel"]);
        $stmt->execute();

        $habitacionDetalle = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $habitacionDetalle[] = new Habitacion($row['id'], $row['id_hotel'], $row['num_habitacion'], $row['tipo'], $row['precio'], $row['descripcion']);
        }

        $stmt2 = $this->pdo->prepare('SELECT * FROM hoteles WHERE id = ' . $_GET["hotel"]);
        $stmt2->execute();

        $hoteles = [];
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel($row2['id'], $row2['nombre'], $row2['direccion'], $row2['ciudad'], $row2['pais'], $row2['num_habitaciones'], $row2['descripcion'], $row2['foto']);
        }

        if ($stmt2->rowCount() == 0) {
            header("Location: ./index.php?controller=Hoteles&action=mostrarNoDisponible");
        }
        
        return array("habitacionDetalle" => $habitacionDetalle, "hoteles" => $hoteles);
    }
}
