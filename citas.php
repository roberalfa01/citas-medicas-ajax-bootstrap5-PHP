<?php
    if(!isset($_SESSION))
    { 
        session_start();
    }
    if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario']))
    {
        header('location: index.php');
    }
    require_once "bd/Conectar.php";
    require_once "Controllers/CrudBase.php";
    $crudBase = new CrudBase();
    $data = $crudBase->listarCitasAprobada();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Citas Pendientes</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php require_once "menu.php" ?>
        <div class="container-fluid">
            <div class="row justify-content-center p-3">
                <h4 class="text-center text-primary fw-bold mb-3">Citas</h4>
                <div class="col-12 col-lg-11 bg-light table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Cita</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="respuesta">
                            <?php
                                foreach($data as $item)
                                {
                            ?>        
                                    <tr>
                                        <td><?=$item['nombre'] ?></td>
                                        <td><?=$item['apellido'] ?></td>
                                        <td><?=date('d-m-Y', strtotime($item['fechaCita'])) ?></td>
                                        <td><a href="#" class="eliminarCita" id="<?=$item['usuarioPaciente']?>"><img src="assets/imagenes/eliminar.svg" width="20" height="20" alt=""></a></td>
                                    </tr>
                            <?php
                                }
                            ?>        
                                 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/ajax.js"></script>
    </body>
</html>