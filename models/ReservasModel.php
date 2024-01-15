<?php

// Uso de include_once para evitar la inclusión múltiple
include_once 'db/DB.php';

class ReservasModel {

    // Obtiene una instancia de PDO para conectarse a la base de datos
    private $bd;
    private $pdo;

    public function __construct() {
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    // Recupera la lista de reservas
    public function getReservas() {
        // Ejecuta una consulta para recuperar todas las reservas
        $stmt = $this->pdo->prepare('SELECT * FROM reservas');
        $stmt->execute();

        $reservas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva($row['id'], $row['id_usuario'], $row['id_hotel'], $row['id_habitacion'], $row['fecha_entrada'], $row['fecha_salida']);
        }
        return $reservas;
    }

    public function postReservas() {
        $sqlId = $this->pdo->prepare('SELECT MAX(id) AS id FROM reservas;');
        $sqlId->execute();

        $id = $sqlId->fetchColumn() + 1;

        // Ejecuta una consulta para insertar una reservas
        $stmt = $this->pdo->prepare('INSERT INTO reservas (id, id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida) VALUES (:id, :id_usuario, :id_hotel, :id_habitacion, :fecha_entrada, :fecha_salida);');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_usuario', $_SESSION['id']);
        $stmt->bindParam(':id_hotel', $_GET['id_hotel']);
        $stmt->bindParam(':id_habitacion', $_GET['id_habitacion']);
        $stmt->bindParam(':fecha_entrada', $_POST['fecha_entrada']);
        $stmt->bindParam(':fecha_salida', $_POST['fecha_salida']);

        $stmt->execute();
        
        header("Location: ./index.php?controller=Hoteles&action=detalles&hotel=".$_GET['id_hotel']."&reserva=check");
    }
}
