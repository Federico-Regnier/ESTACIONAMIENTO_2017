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
            url: "administrador.php",
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
            url: "administrador.php",
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
    
    $("#divContenido").on('click', "#editLink", function(event){
        event.preventDefault();
        var baja = $(this).parent().parent().data("baja");
        var mensaje;
        if(baja == 0){
            var datos = {"Suspender" : true, "id" : $(this).data("id")};
            mensaje = "Seguro que desea suspender al usuario?";
        } else{
            var datos = {"Habilitar" : true, "id" : $(this).data("id")};
            mensaje = "Seguro que desea habilitar al usuario?";
        }
        if(confirm(mensaje)){
            $.ajax({
                url: "administrador.php",
                data: datos,
                method: 'POST',
                async: true
            }).done(function(result){
                if(result != "error"){
                    $("#divContenido").load("listadoUsuarios.php #divContenido");
                } else{
                    alert("No se pudo suspender el usuario");
                }
            });
        }
    });

    $("#logout").on('click',function(event){
        event.preventDefault();
        $.ajax({
            url: "administrador.php",
            data: {"Logout": true},
            method: "GET"
        }).done(function(result){
            if(result == "success"){
                window.location.href = "login.html";
            }
        });
    });
});

function Borrar(id){
    if(confirm("Esta seguro que desea eliminar el usuario?")){
        $.ajax({
            url: "administrador.php",
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