<?php

class HotelesView {

    // Muestra todos los hoteles
    public function mostrarHoteles($hoteles) {
        ?>
        <div class="contenedor">
            <div class="header">
                <h1 class="fw-bold">Bienvenido/a <?php echo ucfirst($_SESSION['nombre']) ?></h1>
                <div>
                    <?php
                    if ($_SESSION["rol"] == 1) {
                        echo '<a href="./index.php?controller=Reservas&action=mostrar" class="header__link">Ver Reservas</a>';
                    }
                    ?>
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>                
            </div>
            <div class="main p-3">
                <h2 class="mb-5">Hoteles Disponibles</h2>
                <?php
                if (isset($_GET['reserva'])) {
                    echo '<p class="text-success">Reserva realizada correctamente</p>';
                }
                ?> 
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>País</th>
                            <th>Ciudad</th>
                            <th>Habitaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($hoteles as $hotel) {
                            ?>
                            <tr>
                                <td><?php echo $hotel->getNombre(); ?></td>
                                <td><?php echo $hotel->getDireccion(); ?></td>
                                <td><?php echo $hotel->getPais(); ?></td>
                                <td><?php echo $hotel->getCiudad(); ?></td>
                                <td><?php echo $hotel->getNum_habitaciones(); ?></td>
                                <td><a class="most__link" href="./index.php?controller=Hoteles&action=detalles&hotel=<?php echo $hotel->getId(); ?>">⬅️ ️Ver detalles</a></td>
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
                    <a href="./index.php?controller=Hoteles&action=mostrar" class="header__link">Volver</a>
                    <a href="./index.php?controller=Login&action=cerrarSesion" class="header__link">Cerrar Sesión</a>
                </div>
            </div>
            <div class="main p-3">
                <h2 class="mb-5 text-center">Hotel seleccionado no disponible o sin habitaciones</h2>                
            </div>            
        </div>
        <?php
    }
}
