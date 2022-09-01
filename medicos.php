<?php
    require_once "bd/Conectar.php";
    require_once "Controllers/CrudBase.php";
    $crudBase = new CrudBase();
    $data = $crudBase->listarMedicos();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Médicos</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php require_once "menu.php" ?>
        <div class="container table-responsive">
            <table class="table">
                <h4 class="text-center my-4">Médicos Especialistas</h4>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>Cita</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($data as $item){
                    ?>
                            <tr>
                                <td><?=$item['nombre']?></td>
                                <td><?=$item['apellido']?></td>
                                <td><?=$item['especialidad']?></td>
                                <td><a href="agregarCitas.php?usuarioMedico=<?=$item['usuario']?>" class="link-primary text-decoration-none">Agregar</a></td>
                            </tr>
                    <?php
                        }
                    ?>

                </tbody>
            </table>
        </div>
        
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>