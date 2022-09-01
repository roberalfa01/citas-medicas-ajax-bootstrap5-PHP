<?php

class Conectar 
{
    public $pdo;
    public function conexion()
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=citas_medicas', 'root', '');
        }catch(PDOException $e){
            echo "Error en Conexión" . $e->getMessage();
        }
        return $pdo;
    }
}