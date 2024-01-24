<?php

// Incluye el archivo que contiene la clase DB para la conexión a la base de datos
include 'db/DB.php';

// Definición de la clase LoginModel
class LoginModel {

    // Propiedades para la conexión a la base de datos
    private $bd;
    private $pdo;

    // Constructor de la clase
    public function __construct() {
        try {
            // Crea una instancia de la clase DB para obtener una conexión PDO a la base de datos
            $this->bd = new DB();
            $this->pdo = $this->bd->getPDO();
        } catch (Exception $exc) {
            // Captura y muestra cualquier excepción ocurrida durante la conexión a la base de datos
            echo $exc->getMessage();
        }
    }

    // Método para comprobar la autenticación del usuario
    public function comprobarUsuario($user, $pass) {
        // Prepara y ejecuta una consulta SQL para buscar un usuario con el nombre y contraseña proporcionados
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE nombre = :user AND contraseña = :pass');
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();

        // Verifica si se encontró al menos un usuario
        if ($stmt->rowCount() > 0) {

            // Recorre los resultados y crea un objeto Usuario con la información obtenida
            foreach ($stmt as $row) {
                $nuevouser = new Usuario($row['id'], $row["nombre"], $row["contraseña"], $row["fecha_registro"], $row["rol"]);
            }

            // Inicia la sesión y establece variables de sesión con la información del usuario
            session_start();
            $_SESSION['nombre'] = $nuevouser->getNombre();
            $_SESSION['rol'] = $nuevouser->getRol();
            $_SESSION['id'] = $nuevouser->getId();
            return true; // Indica que la autenticación fue exitosa
        } else {
            return false; // Indica que la autenticación falló
        }
    }
}