$(function(){
    
    var url = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
    $('#navbar li.active').removeClass('active');
    $("#navbar a").each(function(){
        if($(this).attr('href') == url){
            $(this).parent().addClass('active');
        }
    });
    
    $("#userForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "adminUsuarios.php",
            data: $("#userForm").serialize(),
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
                window.location.href = "main.php";
            } else{
                var div = $("#divResultado");
                div.addClass("alert alert-danger");
                div.html(result);
            }
        });
    });

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

    $("#btnAgregarAuto").click(function(){
        $.ajax({
            url: 'listadoCocheras.php',
            method: 'GET',
        }).done(function(result){
            var listado = $("#divListado");
            listado.removeClass();
            listado.html(result);
        }).error(function(result){
            var listado = $("#divListado");
            listado.addClass("alert alert-danger");
            listado.html("Error en la comunicacion con el servicio. Intentelo mas tarde.");
        });
    });
});


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
            $('#nombre').val(empleado["nombre"]);
            $('#apellido').val(empleado["apellido"]);
            $('#estado').val(empleado["estado"]);
            $('#dni').val(empleado["dni"]);
            var $rol = $('#rol input:radio[name=rol]');
            $rol.removeAttr("checked");
            $rol.filter('[value='+empleado["rol"]+']').prop('checked', true);
            modal.modal('show');
        }
    });
}

function modificarUsuario(id){
    var datos = {
        "ModificarUsuario" : true,
        "id" : $("#id").val(),
        "nombre" : $('#nombre').val(),
        "apellido" : $("#apellido").val(),
        "dni": $("#dni").val(),
        "estado" : $("#estado").val(),
        "rol" : $("#rol").val()
    };
    $.ajax({
        url:"adminUsuarios.php",
        method:"POST",
        data: datos,
        async: true,
    }).done(function(result){
        $("#modalUsuario").modal('hide');
        var div = $("#divResultado");
        div.removeClass();
        if(resultado == "success"){
            div.addClass("alert alert-success");
            div.html("Usuario modificado con exito");
            $("#divContenido").load("listadoUsuarios.php #divContenido");
        } else {
            div.addClass("alert alert-danger");
            div.html(result);
        }
    });
}