$(document).on('click', '.eliminarPaciente', function(){
    var usuarioPaciente = $(this).attr('id');
    $.ajax({
        type: "post",
        url: "eliminarCita.php",
        data: {usuarioPaciente: usuarioPaciente},
        success: function (response) {
            data = JSON.parse(response);
            document.getElementById('respuesta').innerHTML = "";
            for(item of data)
            {
                fecha = item['fechaCita'];
                let fechaCita =  new Date(fecha).toISOString().slice(0, 10).split('-').reverse().join('/'); 

                document.getElementById('respuesta').innerHTML += `
                <tr>
                    <td>${item['nombre']}</td>
                    <td>${item['apellido']}</td>
                    <td>${fechaCita}</td>
                    <td><a href="#" class="aprobrarCita" id="${item['usuarioPaciente']}"><img src="assets/imagenes/hand.svg" width="20" height="20" alt=""></a></td>                                        
                    <td><a href="#" class="eliminarPaciente" id="${item['usuarioPaciente']}"><img src="assets/imagenes/eliminar.svg" width="20" height="20" alt=""></a></td>
                </tr>
                 `   
            }
        }
    });
});

$(document).on('click', '.aprobrarCita', function(){
    var usuarioPaciente = $(this).attr('id');
    $.ajax({
        type: "post",
        url: "aprobarCita.php",
        data: {usuarioPaciente: usuarioPaciente},
        success: function (response) 
        {
            data = JSON.parse(response);
            document.getElementById('respuesta').innerHTML = "";
            for(item of data)
            {
                fecha = item['fechaCita'];
                let fechaCita =  new Date(fecha).toISOString().slice(0, 10).split('-').reverse().join('/'); 

                document.getElementById('respuesta').innerHTML += `
                <tr>
                    <td>${item['nombre']}</td>
                    <td>${item['apellido']}</td>
                    <td>${fechaCita}</td>
                    <td><a href="#" class="aprobrarCita" id="${item['usuarioPaciente']}"><img src="assets/imagenes/hand.svg" width="20" height="20" alt=""></a></td>                                        
                    <td><a href="#" class="eliminarPaciente" id="${item['usuarioPaciente']}"><img src="assets/imagenes/eliminar.svg" width="20" height="20" alt=""></a></td>
                </tr>
                `   
            }
        }
    });
});

$(document).on('click', '.eliminarCita', function(){
    var usuarioPaciente = $(this).attr('id');
    $.ajax({
        type: "post",
        url: "eliminarCitaAprobada.php",
        data: {usuarioPaciente: usuarioPaciente},
        success: function (response) {
            data = JSON.parse(response);
            document.getElementById('respuesta').innerHTML = "";
            for(item of data)
            {
                fecha = item['fechaCita'];
                let fechaCita =  new Date(fecha).toISOString().slice(0, 10).split('-').reverse().join('/'); 

                document.getElementById('respuesta').innerHTML += `
                <tr>
                    <td>${item['nombre']}</td>
                    <td>${item['apellido']}</td>
                    <td>${fechaCita}</td>
                    <td><a href="#" class="eliminarPaciente" id="${item['usuarioPaciente']}"><img src="assets/imagenes/eliminar.svg" width="20" height="20" alt=""></a></td>
                </tr>
                 `   
            }
        }
    });
});