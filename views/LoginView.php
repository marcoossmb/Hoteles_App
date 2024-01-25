<?php

// Definición de la clase LoginView
class LoginView {

    // Método para mostrar el formulario de inicio de sesión
    public function mostrarLogin() {
        // Inicio del contenedor
        ?>
        <div class="contenedor__log">
            <div class="login__box">
                <!-- Título del formulario de inicio de sesión -->
                <h1 class="login__title fw-bold">Iniciar Sesión</h1>

                <?php
                // Verifica si la acción es "procesarLogin" (puede variar según la lógica del controlador)
                if (isset($_GET["errorLog"])) {
                    // Muestra un mensaje de error si el usuario o la contraseña son incorrectos
                    echo '<p class="fw-bold text-danger">Usuario o contraseña incorrecto</p>';
                }
                ?>

                <!-- Formulario de inicio de sesión -->
                <form class="login__form" action="./index.php?controller=Login&action=procesarLogin" method="POST">
                    <label>Usuario:</label>
                    <!-- Campo de entrada para el nombre de usuario -->
                    <input class="form__input" type="text" name="usuario" required>
                    <br>
                    <label>Contraseña:</label>
                    <!-- Campo de entrada para la contraseña -->
                    <input class="form__input" type="password" name="contrasena" required>
                    <br>
                    <!-- Botón de envío del formulario -->
                    <input class="form__button" type="submit" value="Entrar">
                </form>
            </div> 
        </div>
        <?php
        // Fin del contenedor
    }
}
