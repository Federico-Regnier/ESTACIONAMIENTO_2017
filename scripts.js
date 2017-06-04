$(function(){
    $("#userForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "administrador.php",
            data: $("#userForm").serialize(),
            method: "POST",
            
        }).done(function(result){
            alert(result);
        });
    });

   $("#loginForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "login.php",
            data: $("#loginForm").serialize(),
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

    $("#linkEmpleados").click(function(event){
        event.preventDefault();
        $("#divContenido").load("listadoUsuarios.php");
        $('#navbar li.active').removeClass('active');
        var $this = $(this).parent();
        if (!$this.hasClass('active')){
            $this.addClass('active');
        }


    });

    $("#divContenido").on('click', "#editLink", function(event){
        event.preventDefault();
        if($(this).parent().parent().data("baja") == 0){
            var datos = {"Suspender" : true, "id" : $(this).data("id")};
            alert("suspender");
        } else{
            var datos = {"Habilitar" : true, "id" : $(this).data("id")};
            alert("habilitar");
        }
        $.ajax({
            url: "administrador.php",
            data: datos,
            method: 'POST',
            async: true
        }).done(function(result){
            if(result != "error"){
                $("#divContenido").load("listadoUsuarios.php");
            } else{
                alert("No se pudo suspender el usuario");
            }
        });
    });
    
});

