<?php

class HabitacionesView {

    public function mostrarDetalles($detalles) {
        $habitacionDetalle = $detalles["habitacionDetalle"];
        $hoteles = $detalles["hoteles"];
        ?>
        <div class="contenedor mt-2">
            <div class="header">
                <h1 class="fw-bold">Hotel <?php echo $_GET["hotel"] ?></h1>
                <div>
                    <a href="./index.php?controller=Hoteles&action=mostrar" class="header__link">Volver</a>
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>
            </div>
            <div class="main">
                <?php
                foreach ($hoteles as $hotel) {
                    ?>
                    <div class="d-flex flex-column align-items-center">
                        <p><?php echo $hotel->getDescripcion(); ?></p>
                        <img class = "w-25" src = "data:image/jpeg;base64,<?php echo base64_encode($hotel->getFoto()); ?>" alt = "">
                    </div>

                    <?php
                }
                ?>
                <h2 class="fw-bold mt-5">Habitaciones Disponibles:</h2>                                               
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Habitación</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($habitacionDetalle as $detalle) {
                            ?>
                            <tr>
                                <td><?php echo $detalle->getTipo(); ?></td>  
                                <td><?php echo $detalle->getDescripcion(); ?></td>
                                <td><?php echo $detalle->getPrecio(); ?> €</td>
                                <?php
                                if ($_SESSION["rol"] == 0) {
                                    $url_reservar = "./index.php?controller=Reservas&action=reservarHabitacion&id_hotel=" . $_GET['hotel'] . "&id_habitacion=" . $detalle->getId() . "&fecha_entrada=" . date("Y-m-d") . "&fecha_salida=" . date("Y-m-d", strtotime("+1 day"));
                                    echo '<td><a href="'.$url_reservar.'" class="most__link">⬅️ Reservar</a></td>';
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
