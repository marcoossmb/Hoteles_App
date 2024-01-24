<?php

class HabitacionesView {

    /**
     * Muestra los detalles de las habitaciones disponibles en un hotel específico.
     * 
     * @param array $detalles - Array con detalles de habitaciones y del hotel.
     */
    public function mostrarDetalles($detalles) {
        $habitacionDetalle = $detalles["habitacionDetalle"];
        $hoteles = $detalles["hoteles"];
        ?>
        <!-- Contenedor principal -->
        <div class="contenedor mt-2">
            <!-- Encabezado con título y enlaces de navegación -->
            <div class="header">
                <h1 class="fw-bold">Hotel <?php echo $_GET["hotel"] ?></h1>
                <div>
                    <!-- Enlace para volver -->
                    <a href="./index.php?controller=Hoteles&action=mostrar" class="header__link">Volver</a>
                    <!-- Enlace para cerrar sesión -->
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>
            </div>

            <!-- Sección principal -->
            <div class="main">
                <?php
                // Bucle para mostrar información del hotel
                foreach ($hoteles as $hotel) {
                    ?>
                    <div class="d-flex flex-column align-items-center">
                        <!-- Descripción del hotel -->
                        <p><?php echo $hotel->getDescripcion(); ?></p>
                        <!-- Imagen del hotel -->
                        <img class="w-25" src="data:image/jpeg;base64,<?php echo base64_encode($hotel->getFoto()); ?>" alt="">
                    </div>
                    <?php
                }
                ?>

                <!-- Título y mensajes de reserva -->
                <h2 class="fw-bold mt-5">Habitaciones Disponibles:</h2>
                <?php
                // Verificación y mensajes de reserva
                if (isset($_GET['reserva'])) {
                    if ($_GET['reserva'] == 'check') {
                        ?>
                        <!-- Mensaje de reserva exitosa -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Reserva realizada correctamente</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    } else if ($_GET['reserva'] == 'error1') {
                        ?>
                        <!-- Mensaje de error de fechas ya reservadas -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Fechas elegidas ya reservadas</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    } else {
                        ?>
                        <!-- Mensaje de error de fechas incorrectas -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>No puedes elegir una fecha de entrada mayor a la de salida</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                }
                ?>

                <!-- Tabla de habitaciones disponibles -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Habitación</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <?php
                            // Columna adicional para reserva (solo visible para usuarios)
                            if ($_SESSION["rol"] == 0) {
                                echo '<th>Acciones</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Bucle para mostrar detalles de habitaciones
                        foreach ($habitacionDetalle as $index => $detalle) {
                            ?>
                            <tr>
                                <!-- Tipo de Habitación -->
                                <td><?php echo $detalle->getTipo(); ?></td>
                                <!-- Descripción de la Habitación -->
                                <td><?php echo $detalle->getDescripcion(); ?></td>
                                <!-- Precio de la Habitación -->
                                <td><?php echo $detalle->getPrecio(); ?> €</td>
                                <?php
                                // Acciones de reserva (solo visible para usuarios)
                                if ($_SESSION["rol"] == 0) {
                                    $url_reservar = "./index.php?controller=Reservas&action=reservarHabitacion&id_hotel=" . $_GET['hotel'] . "&id_habitacion=" . $detalle->getId();
                                    $id_capa = "miCapa_" . $index;
                                    $fechaactual = date("Y-m-d");
                                    $fechaManana = date("Y-m-d", strtotime($fechaactual . ' +1 day'));
                                    echo '<td>
                                            <a data-toggle="collapse" href="#' . $id_capa . '" class="most__link">⬅️ Reservar</a>
                                            <div class="mt-3 collapse" id="' . $id_capa . '">
                                                <form action="' . $url_reservar . '" method="POST">
                                                    <div class="mb-3">
                                                        <label>Fecha de Entrada:</label>
                                                        <input type="date" min="' . $fechaactual . '" name="fecha_entrada" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Fecha de Salida:</label>
                                                        <input type="date" min="' . $fechaManana . '" name="fecha_salida" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Reservar</button>
                                                </form>
                                            </div>
                                        </td>';
                                }
                                ?>
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