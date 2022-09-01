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
    $data = $crudBase->editarPerfil();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mi Perfil</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php require_once "menu.php";  ?>  
        <div class="container my-4">
            <h4 class="text-center fw-bold">Mi Perfil</h4>
            <div class="row justify-content-center">
                <div class="col-10 col-md-7 col-lg-6 bg-light border border-1 p-5">
                    <form action="Controllers/grabarEditarPerfil.php" method="POST" name="formPerfilEditar" id="formPerfilEditar">
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" maxlength="25" value="<?=$data['nombre']?>">
                        </div>
                        <div class="mb-3">
                            <label>Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" maxlength="25" value="<?=$data['apellido']?>">
                        </div>
                        <div class="mb-3">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" maxlength="15" value="<?=$data['telefono']?>">
                        </div>
                        <?php
                            if($_SESSION['tipo_usuario'] == 'p')
                            {
                        ?>
                                <div class="mb-3">
                                    <label>Edad</label>
                                    <input type="number" name="edad" id="edad" class="form-control" value="<?=$data['edad']?>" >
                                </div>
                                <div class="mb-4">
                                    <label>Alérgias a</label>
                                    <input type="text" name="alergias" id="alergias" class="form-control" maxlength="60" value="<?=$data['alergias']?>">
                                </div>
                        <?php
                            }
                        ?>
                        <?php
                            if($_SESSION['tipo_usuario'] == 'm')
                            {
                        ?>
                                <div class="mb-4">
                                    <label>Especialidad Médica</label>
                                    <input type="text" name="especialidad" id="especialidad" class="form-control" value="<?=$data['especialidad']?>">
                                </div>
                        <?php
                            }
                        ?>
                        <div class="mb-4">
                            <p>Sexo</p>
                            <label>Masculino</label> <input type="radio" name="sexo" id="sexo1" <?php if($data['sexo'] == 'm'){echo 'checked';}?> value="m" class="me-2">
                            <label>Femenino</label> <input type="radio" name="sexo" id="sexo2" <?php if($data['sexo'] == 'f'){echo 'checked';}?> value="f">
                        </div>
                        <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="<?=$_SESSION['tipo_usuario']?>">
                        <input type="button" value="Grabar" name="botonGrabarPerfil" id="botonGrabarPerfil" class="btn btn-secondary form-control">
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/validaciones.js"></script>
    </body>
</html>

