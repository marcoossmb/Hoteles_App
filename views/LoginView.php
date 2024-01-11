<?php

class LoginView {

    // Muestra el formulario de login
    public function mostrarLogin() {
        // Genera el formulario
        ?>
        <h1>Iniciar Sesión</h1>
        <form action="./index.php?controller=Login&action=procesarLogin" method="POST">
            <label>Usuario:</label>
            <input type="text" name="usuario">
            <br>
            <label>Contraseña:</label>
            <input type="password" name="contrasena">
            <br>
            <input type="submit" value="Acceder">
        </form>
        <?php
    }

    // Muestra un mensaje de error
    public function mostrarError($mensaje) {
        echo '<p>Error: ' . $mensaje . '</p>';
    }
}