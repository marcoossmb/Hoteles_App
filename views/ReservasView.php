<?php

class ReservasView {

    public function mostrarReservas($reservas) {
        $reservas1 = $reservas["reservas1"];
        $reservas2 = $reservas["reservas2"];
        ?>
        <div class="contenedor">
            <div class="header">
                <h1 class="fw-bold">Reservas Realizadas</h1>
                <div>
                    <a href="./index.php?controller=Hoteles&action=mostrar" class="header__link">Volver</a>
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>
            </div>
            <div class="main">
                <h2>Usuario 1</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hotel</th>
                            <th>Habitación</th>
                            <th>Fecha Entrada</th>
                            <th>Fecha Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reservas1 as $reserva) {
                            ?>
                            <tr>
                                <td><?php echo $reserva->getId_hotel(); ?></td>
                                <td><?php echo $reserva->getId_habitacion(); ?></td>
                                <td><?php echo $reserva->getFecha_entrada(); ?></td>
                                <td><?php echo $reserva->getFecha_salida(); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <h2>Usuario 2</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hotel</th>
                            <th>Habitación</th>
                            <th>Fecha Entrada</th>
                            <th>Fecha Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reservas2 as $reserva) {
                            ?>
                            <tr>
                                <td><?php echo $reserva->getId_hotel(); ?></td>
                                <td><?php echo $reserva->getId_habitacion(); ?></td>
                                <td><?php echo $reserva->getFecha_entrada(); ?></td>
                                <td><?php echo $reserva->getFecha_salida(); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }   
}
