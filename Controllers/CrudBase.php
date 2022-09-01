<?php

if(!isset($_SESSION)) 
{ 
    session_start();
}


class CrudBase extends Conectar
{    
    public function grabarUsuario() //grabar usuario nuevo medico o paciente
    {
        $pdo = $this->conexion();
        $usuario =  $_POST['usuario'];
        $email =  $_POST['email']; 
        $clave =  $_POST['clave'];
        $condicion =  $_POST['condicion'];
        //busco si existe el usuario ya
        $sql = "select usuario from usuarios where usuario='$usuario'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        if($resultado->rowCount() < 1)
        {
            //grabar Usuario Nuevo
            $data = [
                'usuario' => $usuario,
                'clave' => $clave,
                'email' => $email,
                'condicion' => $condicion,
                'fecha_incorporacion' => date('Y-m-d H:i:s'),
            ];
            $sql = "insert into usuarios (usuario, clave, email, tipo_usuario, fecha_incorporacion) value (:usuario, :clave, :email, :condicion, :fecha_incorporacion)";
            $resultado = $pdo->prepare($sql);
            $resultado->execute($data);
            header('Location: ../index.php');
        }else{
            $comentario = "Usuario Existe";
            header('Location: ../login.php');
        }

    }

    //verificar login de usuario
    public function login()
    {
        $pdo = $this->conexion();
        // chequeamos si existe usuario para entrar
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $sql = "select * from usuarios where usuario = '$usuario' and  clave = '$clave'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll();
        foreach($data as $usuario1){
            $tipo_usuario = $usuario1['tipo_usuario'];
        }
        if($resultado->rowCount() < 1)
        {
            header('Location: ../login.php');
        }else{
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo_usuario'] = $tipo_usuario;
            header('Location: ../index.php');
        }
    }

    //edicion perfil de  usuario
    public function editarPerfil()
    {
        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
        $pdo = $this->conexion();
        $sql = "select * from usuarios where usuario='$usuario' and tipo_usuario='$tipo_usuario'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        if($resultado->rowCount() > 0)
        {
            $dataUsuario = $resultado->fetchAll();
            foreach($dataUsuario as $usuario1)
            {
                $email = $usuario1['email'];
            }
            if($tipo_usuario == 'p')
            {
                $sql = "select * from datos_paciente where usuario='$usuario'";
            }else{
                $sql = "select * from datos_medico where usuario='$usuario'";
            }
            $resultado = $pdo->prepare($sql);
            $resultado->execute();
            if($resultado->rowCount() > 0)
            {
                $dataTipo = $resultado->fetchAll();
                foreach($dataTipo as $usuarioTipo)
                {
                    $nombre = $usuarioTipo['nombre'];
                    $apellido = $usuarioTipo['apellido'];
                    $telefono = $usuarioTipo['telefono'];
                    $sexo = $usuarioTipo['sexo'];
                    if($tipo_usuario == 'm')
                    {
                        $especialidad = $usuarioTipo['especialidad'];
                        $data =
                        [
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'telefono' => $telefono,
                            'especialidad' => $especialidad,
                            'sexo' => $sexo,
                        ];
                    }else{
                        $edad =   $usuarioTipo['edad'];
                        $alergias = $usuarioTipo['alergias'];
                        $data =
                        [
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'telefono' => $telefono,
                            'edad' => $edad,
                            'alergias' => $alergias,
                            'sexo' => $sexo,
                        ];
                    }
                    return $data;
                }
            }else{
                $data =
                [
                    'nombre' => '',
                    'apellido' => '',
                    'telefono' => '',
                    'especialidad' => '',
                    'edad' => '',
                    'alergias' => '',
                    'sexo' => '',
                ];
                return $data;
            }
        }else{
            $mensaje = "No Existe";
        } 
    }

    public function grabarEditarPerfil()
    {
        $pdo = $this->conexion();
        if($_SESSION['tipo_usuario'] == 'm')
        {
            $sql = "select * from datos_medico where usuario='".$_SESSION["usuario"]."'";
            $resultado = $pdo->prepare($sql);
            $resultado->execute();
            if($resultado->rowCount() < 1)
            {
                $sql = "insert into datos_medico (usuario, nombre, apellido, telefono, especialidad, sexo) value (?, ?, ?, ?, ?, ?)";
                $resultado = $pdo->prepare($sql);
                $resultado->execute([$_SESSION['usuario'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['especialidad'], $_POST['sexo']]);
            }else{
                $sql = "update datos_medico SET nombre=?, apellido=?, telefono=?, especialidad=?, sexo=? where usuario='".$_SESSION['usuario']."'";
                $resultado = $pdo->prepare($sql);
                $resultado->execute([$_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['especialidad'], $_POST['sexo']]);
            }
        }else{
            $sql = "select * from datos_paciente where usuario='".$_SESSION["usuario"]."'";
            $resultado = $pdo->prepare($sql);
            $resultado->execute();
            if($resultado->rowCount() < 1)
            {
                $sql = "insert into datos_paciente (usuario, nombre, apellido, telefono, edad, alergias, sexo) value (?, ?, ?, ?, ?, ?, ?)";
                $resultado = $pdo->prepare($sql);
                $resultado->execute([$_SESSION['usuario'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['edad'], $_POST['alergias'], $_POST['sexo']]);
            }else{
                $sql = "update datos_paciente SET nombre=?, apellido=?, telefono=?, edad=?, alergias=?, sexo=? where usuario='".$_SESSION['usuario']."'";
                $resultado = $pdo->prepare($sql);
                $resultado->execute([$_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['edad'], $_POST['alergias'], $_POST['sexo']]);
            }
        }
    } 

    public function listarMedicos()
    {
        $pdo = $this->conexion();
        //listado de medicos
        $sql = "select * from datos_medico order by nombre asc";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data = $resultado->fetchAll();
        return $data;
    }

    public function datosMedicos($usuarioMedico)
    {
        $pdo = $this->conexion();
        //buscar en citas a vez si tiene cita pendiente con ese medico
        $usuarioPaciente = $_SESSION['usuario'];
        $pdo = $this->conexion();
        $sql = "select * from citas where usuarioPaciente='$usuarioPaciente' and usuarioMedico='$usuarioMedico' and estatus='p'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        if($resultado->rowCount() > 0){
            $_SESSION['mensaje'] = "Ya tiene una Cita por Confirmar";
            header("Location: index.php");
            return;
        }
         //buscar datos medico
         $sql = "select * from datos_medico where usuario='$usuarioMedico'";
         $resultado = $pdo->prepare($sql);
         $resultado->execute();
         if($resultado->rowCount() > 0)
         {
             $data = $resultado->fetchAll();
             foreach($data as $item){
                 if($item['sexo'] == 'f'){
                     $titulo = "Dra.";
                 }else{
                     $titulo = "Dr.";
                 }
                 $usuarioMedico = $item['usuario'];
                 $nombre = $item['nombre'];
                 $apellido = $item['apellido'];
                 $especialidad = $item['especialidad'];
             }
         }else{
            $usuario = ""; 
            $titulo = "";
            $nombre = "";
            $apellido = "";
            $especialidad = "";
         }
         $data = [
             'titulo' => $titulo,
             'usuarioMedico' => $usuarioMedico,
             'nombre' => $nombre,
             'apellido' => $apellido,
             'especialidad' => $especialidad,
         ];
         return $data;
    }
    public function grabarCita()
    {
        $usuarioPaciente = $_SESSION['usuario'];
        $usuarioMedico = $_POST['usuarioMedico'];
        $pdo = $this->conexion();
        $sql = "insert into citas (usuarioPaciente, usuarioMedico, fechaCita, estatus) value (?, ?, ?, ?)";
        $resultado = $pdo->prepare($sql);
        $resultado->execute([$usuarioPaciente, $usuarioMedico, $_POST['fechaCita'], 'p']);
        $_SESSION['mensaje'] = "Su  Cita Fue Recibida lo estaremos contactando";
        header('Location: ../index.php');
    }

    public function listarCitasPorAprobar()
    {
        $pdo = $this->conexion();

        //Sacar los datos del paciente con join
        $sql = "select * from citas c INNER JOIN datos_paciente p ON c.usuarioPaciente = p.usuario where usuarioMedico = '".$_SESSION['usuario']."' and estatus='p'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data =$resultado->fetchAll();
        return $data;
    }

    public function eliminarCita()
    {
        $pdo = $this->conexion();
        $usuarioPaciente = $_POST['usuarioPaciente'];
        $usuarioMedico = $_SESSION['usuario'];
        //eliminar  citas
        $sql = "delete from citas where usuarioPaciente = ? and usuariomedico = ?";
        $resultado = $pdo->prepare($sql);
        $resultado->execute(array($usuarioPaciente, $usuarioMedico));
        //nueva consulta despues de eliminar
        $sql = "select * from citas c INNER JOIN datos_paciente p ON c.usuarioPaciente = p.usuario where usuarioMedico = '".$_SESSION['usuario']."' and estatus='p'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data =$resultado->fetchAll();
        return $data;
    }

    public function aprobarCita()
    {
        $pdo = $this->conexion();
        $usuarioPaciente = $_POST['usuarioPaciente'];
        $usuarioMedico = $_SESSION['usuario'];
        //eliminar  citas
        $sql = "update citas set estatus = ? where usuarioPaciente = '$usuarioPaciente' and usuarioMedico = '$usuarioMedico'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute(['a']);

        //nueva consulta despues de eliminar
        $sql = "select * from citas c INNER JOIN datos_paciente p ON c.usuarioPaciente = p.usuario where usuarioMedico = '".$_SESSION['usuario']."' and estatus='p'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data =$resultado->fetchAll();
        return $data;
    }

    public function listarCitasAprobada()
    {
        $pdo = $this->conexion();

        //Sacar los datos del paciente con join
        $sql = "select * from citas c INNER JOIN datos_paciente p ON c.usuarioPaciente = p.usuario where usuarioMedico = '".$_SESSION['usuario']."' and estatus='a'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data =$resultado->fetchAll();
        return $data;
    }
    
    public function eliminarCitaAprobada()
    {
        $pdo = $this->conexion();
        $usuarioPaciente = $_POST['usuarioPaciente'];
        $usuarioMedico = $_SESSION['usuario'];
        //eliminar  citas
        $sql = "delete from citas where usuarioPaciente = ? and usuariomedico = ?";
        $resultado = $pdo->prepare($sql);
        $resultado->execute(array($usuarioPaciente, $usuarioMedico));
        //nueva consulta despues de eliminar
        $sql = "select * from citas c INNER JOIN datos_paciente p ON c.usuarioPaciente = p.usuario where usuarioMedico = '".$_SESSION['usuario']."' and estatus='a'";
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
        $data =$resultado->fetchAll();
        return $data;
    }

}
