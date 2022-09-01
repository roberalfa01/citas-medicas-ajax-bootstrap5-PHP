<?php

require_once "bd/Conectar.php";
require_once "controllers/CrudBase.php";

$CrudBase = new CrudBase();
$data = $CrudBase->aprobarCita();





echo json_encode($data);