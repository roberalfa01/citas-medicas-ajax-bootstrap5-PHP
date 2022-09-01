<?php
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
if($usuario == "" || $clave == "")
{
    header('Location: ../login.php');
}else{
    require_once "../bd/Conectar.php";
    require_once "CrudBase.php";
    $crudBase = new CrudBase();
    $crudBase->login();
}
