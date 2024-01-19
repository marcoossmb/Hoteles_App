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
                                <td><a class="most__link" href="./index.php?controller=Reservas&action=mostrardetalles&reserva=<?php echo $reserva->getId(); ?>">⬅️ Ver detalles</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <h2 class="mt-5">Usuario 2</h2>
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
                                <td><a class="most__link" href="./index.php?controller=Reservas&action=mostrardetalles&reserva=<?php echo $reserva->getId(); ?>">⬅️ Ver detalles</a></td>
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

    public function detallesReserva($detareservas) {
        $reservas = $detareservas["reservas"];
        $hoteles = $detareservas["hoteles"];
        $habitaciones = $detareservas["habitaciones"];
        ?>
        <div class="contenedor">
            <div class="header">
                <h1 class="fw-bold">Reserva Id <?php echo $_GET['reserva'] ?></h1>
                <div>
                    <a href="./index.php?controller=Reservas&action=mostrar" class="header__link">Volver</a>
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>
            </div>
            <div class="main">
                <h2>Datos del Hotel</h2>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Hotel</th>
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>País</th>
                            <th>Habitaciones</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($hoteles as $hotel) {
                            ?>
                            <tr>
                                <td><?php echo $hotel->getNombre(); ?></td>
                                <td><?php echo $hotel->getDireccion(); ?></td>
                                <td><?php echo $hotel->getCiudad(); ?></td>
                                <td><?php echo $hotel->getPais(); ?></td>
                                <td><?php echo $hotel->getNum_habitaciones(); ?></td>
                                <td><?php echo $hotel->getDescripcion(); ?></td>
                                <div class="d-flex justify-content-center">
                                    <img class = "w-25" src = "data:image/jpeg;base64,<?php echo base64_encode($hotel->getFoto()); ?>" alt = ""> 
                                </div>
                            </tr>                                
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <h2 class="mt-5">Datos de la habitación</h2>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Habitación</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($habitaciones as $habitacion) {
                            ?>
                            <tr>
                                <td>Nº <?php echo $habitacion->getNum_habitacion(); ?></td>
                                <td><?php echo $habitacion->getTipo(); ?></td>  
                                <td><?php echo $habitacion->getDescripcion(); ?></td>
                                <td><?php echo $habitacion->getPrecio(); ?> €</td>
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

    public function mostrarNoDisponible() {
        ?>
        <div class="contenedor">
            <div class="header">
                <h1 class="fw-bold">Bienvenido/a <?php echo ucfirst($_SESSION['nombre']) ?></h1>        
                <div>
                    <a href="./index.php?controller=Reservas&action=mostrarReservas" class="header__link">Volver</a>
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>
            </div>
            <div class="main p-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h2 class="text-center">Reserva seleccionada no disponible o inexistente</h2>
                </div>
            </div>            
        </div>
        <?php
    }
}
