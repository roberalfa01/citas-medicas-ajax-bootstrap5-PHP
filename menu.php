<nav class="navbar navbar-expand-lg navbar-dark fondo-principal">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="assets/imagenes/logo.png" width="50" height="50" alt="" class="d-inline-block align-text-top img-fluid"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-auto">
                <a class="nav-link active" href="index.php">Inicio</a>
                <a class="nav-link active" href="medicos.php">Médicos</a>
                <?php
                    if(!isset($_SESSION['usuario']))
                    {
                        echo '<a class="nav-link active" href="login.php">Login</a>';
                    }else{
                        if($_SESSION['tipo_usuario'] == 'm')
                        {
                            echo '<a class="nav-link active" href="citas.php">Citas</a>';
                            echo '<a class="nav-link active" href="pacientes.php">Confirmación</a>';
                        }
                        echo '<a class="nav-link active" href="perfil.php">Mi Perfil</a>';
                        echo '<a class="nav-link active" href="salir.php">Salir</a>';
                    }
                ?>
            </div>
        </div>
    </div>
</nav>
<?php
require_once "menu.php";
if(isset($_SESSION['usuario']))
{
?>
    <div class="container text-end">
        <?= $_SESSION['usuario']?>
    </div>
<?php
}
?>