<?php

// Utiliza include_once para evitar la inclusión múltiple de la clase DB
include_once 'db/DB.php';

class ReservasModel {

    // Propiedades para la conexión a la base de datos
    private $bd;
    private $pdo;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct() {
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Obtiene las reservas para dos usuarios diferentes.
     * Retorna un array con las reservas para cada usuario.
     */
    public function getReservas() {
        // Consulta SQL para obtener reservas del primer usuario
        $stmt = $this->pdo->prepare('SELECT * FROM reservas WHERE id_usuario=1');
        $stmt->execute();

        // Inicializa un array para almacenar objetos Reserva
        $reservas1 = [];

        // Recorre los resultados y crea objetos Reserva con la información obtenida
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas1[] = new Reserva($row['id'], $row['id_usuario'], $row['id_hotel'], $row['id_habitacion'], $row['fecha_entrada'], $row['fecha_salida']);
        }

        // Consulta SQL para obtener reservas del segundo usuario
        $stmt2 = $this->pdo->prepare('SELECT * FROM reservas WHERE id_usuario=2');
        $stmt2->execute();

        // Inicializa un array para almacenar objetos Reserva
        $reservas2 = [];

        // Recorre los resultados y crea objetos Reserva con la información obtenida
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $reservas2[] = new Reserva($row['id'], $row['id_usuario'], $row['id_hotel'], $row['id_habitacion'], $row['fecha_entrada'], $row['fecha_salida']);
        }

        // Retorna un array con las reservas para cada usuario
        return array("reservas1" => $reservas1, "reservas2" => $reservas2);
    }

    public function getReservasUsu() {
        // Consulta SQL para obtener reservas del primer usuario
        $stmt = $this->pdo->prepare('SELECT * FROM reservas WHERE id_usuario=' . $_SESSION['id']);
        $stmt->execute();

        // Inicializa un array para almacenar objetos Reserva
        $reservas = [];

        // Recorre los resultados y crea objetos Reserva con la información obtenida
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva($row['id'], $row['id_usuario'], $row['id_hotel'], $row['id_habitacion'], $row['fecha_entrada'], $row['fecha_salida']);
        }

        // Retorna un array con las reservas para cada usuario
        return $reservas;
    }

    /**
     * Procesa la reserva de una habitación.
     * Realiza verificaciones y redirige según el resultado.
     */
    public function postReservas() {
        // Verifica si la fecha de entrada es mayor que la fecha de salida
        if ($_POST['fecha_entrada'] > $_POST['fecha_salida']) {
            header("Location: ./index.php?controller=Habitaciones&action=detalles&hotel=" . $_GET['id_hotel'] . "&reserva=error2");
            exit();
        }

        // Consulta para verificar si existen reservas para las mismas fechas en el mismo hotel y habitación
        $sqlVerificacion = $this->pdo->prepare('SELECT COUNT(*) FROM reservas WHERE id_hotel = :id_hotel AND id_habitacion = :id_habitacion AND NOT (fecha_entrada >= :fecha_salida OR fecha_salida <= :fecha_entrada);');

        // Asigna los parámetros a la consulta
        $sqlVerificacion->bindParam(':id_hotel', $_GET['id_hotel']);
        $sqlVerificacion->bindParam(':id_habitacion', $_GET['id_habitacion']);
        $sqlVerificacion->bindParam(':fecha_entrada', $_POST['fecha_entrada']);
        $sqlVerificacion->bindParam(':fecha_salida', $_POST['fecha_salida']);

        // Ejecuta la consulta
        $sqlVerificacion->execute();

        // Obtiene el resultado de la consulta
        $reservasExisten = $sqlVerificacion->fetchColumn();

        // Verifica si existen reservas para las mismas fechas en el mismo hotel y habitación
        if ($reservasExisten > 0) {
            // Existen reservas para exactamente esas fechas en este hotel y habitación, muestra un error
            header("Location: ./index.php?controller=Habitaciones&action=detalles&hotel=" . $_GET['id_hotel'] . "&reserva=error1");
        } else {
            // Obtiene el ID máximo de reservas y asigna un nuevo ID para la nueva reserva
            $sqlId = $this->pdo->prepare('SELECT MAX(id) AS id FROM reservas;');
            $sqlId->execute();

            $id = $sqlId->fetchColumn() + 1;

            // Consulta SQL para insertar una nueva reserva
            $stmt = $this->pdo->prepare('INSERT INTO reservas (id, id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida) VALUES (:id, :id_usuario, :id_hotel, :id_habitacion, :fecha_entrada, :fecha_salida);');

            // Asigna los parámetros a la consulta
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_usuario', $_SESSION['id']);
            $stmt->bindParam(':id_hotel', $_GET['id_hotel']);
            $stmt->bindParam(':id_habitacion', $_GET['id_habitacion']);
            $stmt->bindParam(':fecha_entrada', $_POST['fecha_entrada']);
            $stmt->bindParam(':fecha_salida', $_POST['fecha_salida']);

            // Ejecuta la consulta para insertar la nueva reserva
            $stmt->execute();

            // Redirige a la página de detalles de habitaciones con un mensaje de éxito
            header("Location: ./index.php?controller=Habitaciones&action=detalles&hotel=" . $_GET['id_hotel'] . "&reserva=check");
        }
    }

    /**
     * Obtiene detalles de una reserva específica.
     * Retorna un array con objetos Reserva, Hotel y Habitacion correspondientes.
     * Redirige a la página de no disponible si no hay reservas.
     */
    public function getReservasDetalle() {
        // Consulta SQL para obtener detalles de una reserva específica
        $stmt = $this->pdo->prepare('SELECT * FROM reservas r JOIN hoteles h ON r.id_hotel=h.id JOIN habitaciones hab ON r.id_habitacion=hab.id WHERE r.id=' . $_GET['reserva']);
        $stmt->execute();

        // Inicializa arrays para almacenar objetos Reserva, Hotel y Habitacion
        $reservas = [];
        $hoteles = [];
        $habitaciones = [];

        // Recorre los resultados y crea objetos Reserva, Hotel y Habitacion con la información obtenida
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva($row['id'], $row['id_usuario'], $row['id_hotel'], $row['id_habitacion'], $row['fecha_entrada'], $row['fecha_salida']);
            $hoteles[] = new Hotel($row['id'], $row['nombre'], $row['direccion'], $row['ciudad'], $row['pais'], $row['num_habitaciones'], $row['descripcion'], $row['foto']);
            $habitaciones[] = new Habitacion($row['id'], $row['id_hotel'], $row['num_habitacion'], $row['tipo'], $row['precio'], $row['descripcion']);
        }

        // Redirige a la página de no disponible si no hay reservas
        if (empty($reservas)) {
            header("Location: ./index.php?controller=Reservas&action=mostrarNoDisponible");
        }

        // Retorna un array con objetos Reserva, Hotel y Habitacion correspondientes
        return array("reservas" => $reservas, "hoteles" => $hoteles, "habitaciones" => $habitaciones);
    }
}
