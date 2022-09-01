<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php require_once "menu.php"?>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-sm-7 col-lg-4 bg-light p-5 border border-1">
                    <form action="controllers/verificarLogin.php" name="form_login" id="form_login" method="post">
                        <div class="mb-3">
                            <label>Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Clave</label>
                            <input type="password" name="clave" id="clave" class="form-control">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-secondary form-control">Entrar</button>
                        </div>
                    </form>
                    <div class="mb-3 text-center">
                        <a href="registrarse.php"><button class="btn btn-secondary form-control" id="botonRegistarse">Registrarse</button></a>
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-secondary form-control">Olvide Contraseña</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>