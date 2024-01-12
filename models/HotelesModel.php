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
}