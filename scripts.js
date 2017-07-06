$(function(){
    // Para el highlight de la navbar
    var url = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
    $('#navbar li.active').removeClass('active');
    $("#navbar a").each(function(){
        if($(this).attr('href') == url){
            $(this).parent().addClass('active');
        }
    });
    
    // Envia el formulario con los datos de registro al adminUsuarios
    $("#userForm").submit(function(event){
        event.preventDefault();

        //Serializa el form y le agrega la clave AgregarUsuario
        var data = $("#userForm").serializeArray();
        data.push({name:"AgregarUsuario", value: true});

        $.ajax({
            url: "adminUsuarios.php",
            data: $.param(data),
            method: "POST",
           dataType: "json" 
        }).done(function(result){
            if(result["Status"]== "success"){
                window.location.href = "listadoUsuarios.php";
            }
            else{
                $("#divResultado").html('<div class="alert alert-danger">'+result["Mensaje"] +'</div>');
            }
        });
    });

    // Envia el formulario con los datos de login al adminUsuarios
    $("#loginForm").submit(function(event){
        event.preventDefault();
        var data = $("#loginForm").serializeArray();
        data.push({name:"Login", value: true});
        
        $.ajax({
            url: "adminUsuarios.php",
            data: $.param(data),
            method: "POST",
            
        }).done(function(result){
            if(result == "success"){
                window.location.href = "index.php";
            } else{
                var div = $("#divResultado");
                div.addClass("alert alert-danger");
                div.html(result);
            }
        });
    });

    // Envia una peticion de logout al adminUsuarios
    $("#logout").on('click',function(event){
        event.preventDefault();
        $.ajax({
            url: "adminUsuarios.php",
            data: {"Logout": true},
            method: "GET"
        }).done(function(result){
            if(result == "success"){
                window.location.href = "login.html";
            }
        });
    });
});

// Borra el usuario pasado por id
function Borrar(id){
    if(confirm("Esta seguro que desea eliminar el usuario?")){
        $.ajax({
            url: "adminUsuarios.php",
            data: {"Borrar": true, "id": id},
            method: 'POST',
            async: true
        }).done(function(result){
            if(result != "error"){
                $("#divContenido").load("listadoUsuarios.php #divContenido");
            } else{
                alert("No se pudo borrar el usuario");
            }
        });
    }
}

// Carga el modal con los datos del usuario y lo muestra
function editarUsuario(id){
    event.preventDefault();
    $.ajax({
        url:"adminUsuarios.php",
        method:'POST',
        data:{"TraerUsuario": true, "id" : id},
        async: true,
        dataType: "json"
    }).done(function(result){
        if(result["Status"]!= "error" && result["Resultado"]!= ""){
            var modal = $("#modalUsuario");
            var empleado = result["Resultado"];

            $('#id').val(empleado["id"]);
            $("#usuario").val(empleado["usuario"]);
            $('#nombre').val(empleado["nombre"]);
            $('#apellido').val(empleado["apellido"]);
            $('#dni').val(empleado["dni"]);
            $("#turno").val(empleado["turno"]);
            $('#estado').val(empleado["estado"]);
            var $rol = $('#rol input:radio[name=rol]');
            $rol.removeAttr("checked");
            $rol.filter('[value='+empleado["rol"]+']').prop('checked', true);
            modal.modal('show');
        }
    });
}

// Modifica el usuario con los datos pasados en el modal
function modificarUsuario(id){
    var datos = {
        "ModificarUsuario" : true,
        "id" : $("#id").val(),
        "nombre" : $('#nombre').val(),
        "apellido" : $("#apellido").val(),
        "dni": $("#dni").val(),
        "turno": $("#turno").val(),
        "estado" : $("#estado").val(),
        "rol" : $("#rol input:checked").val()
    };
    $.ajax({
        url:"adminUsuarios.php",
        method:"POST",
        data: datos,
        async: true,
    }).done(function(result){
        $("#modalUsuario").modal('hide');
        if(!$("#divResultado").length){
            $("#contenedor").prepend('<div id="divResultado" class="alert alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p></p></div>');
        }
        var div = $("#divResultado");
        if(result == "success"){
            div.removeClass("alert-danger");
            div.addClass("alert-success");
            div.find('p').html("Usuario modificado con exito");
            $("#divContenido").load("listadoUsuarios.php #divContenido");
        } else {
            div.removeClass("alert-success");
            div.addClass("alert-danger");
            div.find('p').html(result);
        }
    });
}
