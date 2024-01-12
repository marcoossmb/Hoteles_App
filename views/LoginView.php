<?php

class LoginView {

    // Muestra el formulario de login
    public function mostrarLogin() {
        // Genera el formulario
        ?>
        <div class="contenedor__log">
            <div class="login__box">
                <h1 class="login__title fw-bold">Iniciar Sesión</h1>
                <?php
                if (isset($_GET["action"])) {
                    if ($_GET["action"] == "procesarLogin") {
                        echo '<p class="fw-bold text-danger">Usuario o contraseña incorrecto</p>';
                    }
                }
                ?>
                <form class="login__form" action="./index.php?controller=Login&action=procesarLogin" method="POST">
                    <label>Usuario:</label>
                    <input class="form__input" type="text" name="usuario" required>
                    <br>
                    <label>Contraseña:</label>
                    <input class="form__input" type="password" name="contrasena" required>
                    <br>
                    <input class="form__button" type="submit" value="Entrar">
                </form>
            </div> 
        </div>
        <?php
    }
}
