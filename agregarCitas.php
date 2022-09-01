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
    $data = $crudBase->datosMedicos($_GET['usuarioMedico']);
    $fechaHoy = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agregar Cita</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php require_once "menu.php"?>
        <div class="container mt-4">
            <p class="text-center fw-bold"><span class="text-primary">Cita </span><?= $data['titulo']." ".$data['nombre']." ".$data['apellido']." "."(".$data['especialidad'].")" ?></p>
            <div class="row justify-content-center">
                <div class="col-10 col-md-8 bg-light p-5">
                    <form action="Controllers/grabarCita.php" name="formGrabarCita" method="POST">
                        <div class="mb-3">
                            <label class="me-3">Fecha Sugeridad Cita</label><input type="date" name="fechaCita" id="fechaCita" min="<?=$fechaHoy?>" required>
                        </div>
                        <div class="mb-5">
                            <input type="hidden" name="usuarioMedico" value="<?=$data['usuarioMedico']?>">
                            <input type="submit" class="btn btn-secondary" value="Pedir Cita">
                        </div>
                        <div>
                            <p class="fw-bold">Una vez que pida la cita sera contactado para verificar disponibilidad y hora.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>