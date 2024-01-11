<?php

include 'db/DB.php';

class LoginModel {

    // Obtiene una instancia de PDO para conectarse a la base de datos
    private $bd;
    private $pdo;

    public function __construct() {
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    // Recupera la lista de tareas de la base de datos
    public function comprobarUsuario($user, $pass) {
        // Ejecuta una consulta para recuperar todas los usuarios
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE nombre = :user AND contraseña = :pass');
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo 'hola';
        } else {
            header("Location: ./index.php?error");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}