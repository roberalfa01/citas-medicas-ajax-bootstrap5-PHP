// agregar un usuario nuevo (paciente o médico)
if(document.getElementById('form_registrarse'))
{
    document.getElementById('botonRegistrar').addEventListener('click', function(){
        if(document.getElementById('usuario').value == "")
        {
            alert("Debe escribir su Usuario");
            document.form_registrarse.usuario.focus();
            return 0;
        }
        if(document.getElementById('email').value == "")
        {
            alert("Debe escribir su Email");
            document.form_registrarse.email.focus();
            return 0;
        }
        if(document.getElementById('clave').value == "" || document.getElementById('clave').value.length < 6)
        {
            alert("Debe escribir su Clave Mayor a 5 digitos");
            document.form_registrarse.clave.focus();
            return 0;
        }
        if(document.getElementById('confirmar').value == "" || document.getElementById('confirmar').value.length < 6)
        {
            alert("Debe confirmar su clave");
            document.form_registrarse.confirmar.focus();
            return 0;
        }
        if(document.getElementById('clave').value != document.getElementById('confirmar').value)
        {
            alert("Las claves no Coincide");
            document.form_registrarse.clave.focus();
            return 0;
        }
        if(!document.getElementById('condicion1').checked && !document.getElementById('condicion2').checked)
        {
            alert("debe selecionar una option");
            return 0;
        }else{
            valorActivo = document.querySelector('input[name="condicion"]:checked').value;
        }
        document.form_registrarse.submit();
    });
}

document.getElementById('botonGrabarPerfil').addEventListener('click', function(){   
    if(document.getElementById('nombre').value == ''){
        alert('Escriba su Nombre');
        document.formPerfilEditar.nombre.focus();
        return 0;
    }
    if(document.getElementById('apellido').value == ''){
        alert('Escriba su Apellido');
        document.formPerfilEditar.apellido.focus();
        return 0;
    }
    if(document.getElementById('telefono').value == ''){
        alert('Escriba su Telefono');
        document.formPerfilEditar.telefono.focus();
        return 0;
    }
    if(document.getElementById('tipo_usuario').value == 'p')
    {
        if(document.getElementById('edad').value == ''){
            alert('Escriba su edad en Números');
            document.formPerfilEditar.edad.focus();
            return 0;
        }
        if(document.getElementById('alergias').value == ''){
            alert('Escriba si es Alergico a');
            document.formPerfilEditar.alergias.focus();
            return 0;
        }
    }else{
        if(document.getElementById('especialidad').value == ''){
            alert('Escriba su especialidad');
            document.formPerfilEditar.especialidad.focus();
            return 0;
        }
    }
    if(!document.getElementById('sexo1').checked && !document.getElementById('sexo2').checked){
        alert("Seleccione Sexo");
        return 0;
    }
    document.formPerfilEditar.submit();
});