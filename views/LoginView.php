<?php

// Definición de la clase LoginView
class LoginView {

    // Método para mostrar el formulario de inicio de sesión
    public function mostrarLogin() {
        // Inicio del contenedor
        ?>
        <div class="login-page mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="bg-white shadow rounded">
                            <div class="row">
                                <div class="col-md-7 pe-0">
                                    <div class="form-left h-100 py-5 px-5">
                                        <h1 class="mb-5 link__log fw-bold">Iniciar Sesión</h1>
                                        <?php
                                        // Verifica si la acción es "procesarLogin" (puede variar según la lógica del controlador)
                                        if (isset($_GET["errorLog"])) {
                                            // Muestra un mensaje de error si el usuario o la contraseña son incorrectos
                                            echo '<p class="fw-bold text-danger text-center">Usuario o contraseña incorrecto</p>';
                                        }
                                        ?>
                                        <form class="row g-4" action="./index.php?controller=Login&action=procesarLogin" method="POST">
                                            <div class="col-12">
                                                <label>Usuario<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">🙍🏻‍♂</div>
                                                    <input type="text" class="form-control" name="usuario" maxlength="20" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>Contraseña<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">🔐</div>
                                                    <input type="password" class="form-control" name="contrasena" maxlength="20" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                    <label class="form-check-label" for="inlineFormCheck">Recordarme</label>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <a href="#" class="float-end text-decoration-none link__log">¿Olvidaste tu Contraseña?</a>
                                            </div>

                                            <div class="col-12 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary px-4 float-end mt-4 col-4 btn__log">Entrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-5 ps-0 d-none d-md-block">
                                    <div class="form-right h-100 text-white text-center pt-5">
                                        <img class="w-75 object-fit-cover rounded" src="./assets/images/logotipo.jpeg" alt="alt"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // Fin del contenedor
    }
}