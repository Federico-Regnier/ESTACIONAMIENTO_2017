$(function(){
    var passConfirmar = $("#passConfirmar");
    var passNueva = $("input[name=passNueva]");
    passConfirmar.on('keyup', function(){
        if(passNueva.val() != passConfirmar.val()){
            passConfirmar.css('border-color' , '#E34234');
            passNueva.css('border-color' , '#E34234');
        } else {
            passConfirmar.css('border-color' , '#4BB543');
            passNueva.css('border-color' , '#4BB543');
            
        }
    });

    $('#passForm').on('submit', function(event){
        event.preventDefault();
        var divResultado = $("#divResultado");
        if(passNueva.val() != passConfirmar.val()){
            divResultado.removeClass('alert-success');
            divResultado.addClass('alert-danger');
            divResultado.html('Las contrase&ntilde;as deben coincidir');
            divResultado.show();
            return;
        }
        
        var data = $("#passForm").serializeArray();
        data.push({name: "CambiarPass", value: true});
        $.ajax({
            url: "ADMINISTRADOR/adminUsuarios.php",
            data: $.param(data),
            method: "POST",
        }).done(function(result){
            if(result == "success"){
                divResultado.removeClass('alert-danger');
                divResultado.addClass('alert-success');
                $("#divResultado").html('Contrase&ntilde;a cambiada con &eacute;xito');
            }
            else{
                divResultado.removeClass('alert-success');
                divResultado.addClass('alert-danger');
                $("#divResultado").html(result);
            }
        }).fail(function(result){
            //console.log(result);
            divResultado.removeClass('alert-success');
            divResultado.addClass('alert-danger');
            $("#divResultado").html('Error al intentar cambiar la contrase&ntilde;a. Intentelo m&aacute;s tarde.');
        });
        divResultado.show();
    });
});