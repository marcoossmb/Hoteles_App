<?php

class HotelesView {

    // Muestra todos los hoteles
    public function mostrarHoteles($hoteles) {
        ?>
        <div class="contenedor">
            <div class="header">
                <h1 class="fw-bold">Bienvenido/a <?php echo ucfirst($_SESSION['nombre']) ?></h1>
                <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
            </div>

            <?php
            foreach ($hoteles as $hotel) {
                echo $hotel->getNombre() . "<br>";
                echo $hotel->getDireccion() . "<br>";
                echo '<br>';
            }
            ?>
        </div>
        <?php
    }
}