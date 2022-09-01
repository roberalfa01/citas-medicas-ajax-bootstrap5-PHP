<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php require_once "menu.php" ?>    
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-sm-7 col-lg-4 bg-light p-5 border border-1">
                    <form action="controllers/agregarUsuario.php" name="form_registrarse" id="form_registrarse" method="post">
                        <div class="mb-3">
                            <label>Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" maxlength="20">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control" maxlength="120">
                        </div>
                        <div class="mb-3">
                            <label>Clave</label>
                            <input type="password" name="clave" id="clave" class="form-control" minlength="6" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label>Confirmar Clave</label>
                            <input type="password" name="confirmar" id="confirmar" class="form-control" minlength="6" maxlength="10">
                        </div>
                        <div class="mb-4">
                            <div><label>Condición</label></div>
                            <label>Paciente</label> <input type="radio" name="condicion" id="condicion1" value="p" class="me-3">
                            <label>Médico</label> <input type="radio" name="condicion"  id="condicion2" value="m">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="button" class="btn btn-secondary form-control" id="botonRegistrar">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/validaciones.js"></script>
    </body>
</html>