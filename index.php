<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Citas Médicas</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php 
            require_once "menu.php";
            if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != ""){
                echo '<div class="text-center mt-5"><h2>'.$_SESSION['mensaje'].'</h2></div>';
                $_SESSION['mensaje'] = "";
            }
        ?>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>