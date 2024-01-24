<?php

// Incluye la clase de conexión a la base de datos evitando la inclusión múltiple
include_once 'db/DB.php';

class HotelesModel {

    // Propiedades para la conexión a la base de datos
    private $bd;
    private $pdo;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct() {
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    // Obtiene la lista de hoteles desde la base de datos
    public function getHoteles() {
        // Prepara y ejecuta una consulta SQL para obtener todos los hoteles
        $stmt = $this->pdo->prepare('SELECT * FROM hoteles');
        $stmt->execute();

        // Inicializa un array para almacenar los objetos Hotel
        $hoteles = [];

        // Recorre los resultados y crea objetos Hotel con la información obtenida
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel($row['id'], $row['nombre'], $row['direccion'], $row['ciudad'], $row['pais'], $row['num_habitaciones'], $row['descripcion'], $row['foto']);
        }

        // Retorna el array de hoteles
        return $hoteles;
    }
}