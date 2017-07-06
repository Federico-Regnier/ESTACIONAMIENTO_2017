$(function(){
    TraerPrecios();
    $("#preciosForm").on('submit', function(event){
        event.preventDefault();
        ModificarPrecios();
    });
});

function TraerPrecios(){
    let divResultado = $("#divResultado");
    $.ajax({
        url: 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Precios',
        method: 'GET',
        dataType: 'json',
        async: true
    }).done(function(result){
        if($.isEmptyObject(result)){
            divResultado.removeClass("alert-success");
            divResultado.addClass("alert-danger");
            divResultado.html("Error al obtener los precios. Intentelo m&aacute;s tarde.");
            divResultado.show();
            return;
        }
        $("#precioHora").val(result["Hora"]);
        $("#precioMediaEstadia").val(result["Media_Estadia"]);
        $("#precioEstadia").val(result["Estadia"]);
        divResultado.hide();
    }).fail(function(result){
        divResultado.removeClass("alert-success");
        divResultado.addClass("alert-danger");
        divResultado.html("Error al comunicarse con la API. Intentelo m&aacute;s tarde.");
        divResultado.show();
    });
}

function ModificarPrecios(){
    let precioHora = $("#precioHora").val();
    let precioMediaEstadia = $("#precioMediaEstadia").val();
    let precioEstadia = $("#precioEstadia").val();
    let divResultado = $("#divResultado");
    
    $.ajax({
        url: 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Precios',
        method: 'PUT',
        data: {"Hora": precioHora, "MediaEstadia": precioMediaEstadia, "Estadia": precioEstadia},
        dataType: 'json',
        async: true
    }).done(function(result){
        if(result == "success"){
            divResultado.removeClass("alert-danger");
            divResultado.addClass("alert-success");
            divResultado.html("Precios modificados con &eacute;xito.");
        } else {
            divResultado.removeClass("alert-success");
            divResultado.addClass("alert-danger");
            divResultado.html("Error al modificar los precios. Intentelo m&aacute;s tarde.");
        }
    }).fail(function(result){
        divResultado.removeClass("alert-success");
        divResultado.addClass("alert-danger");
        divResultado.html("Error al comunicarse con la API. Intentelo m&aacute;s tarde.");
    });

    divResultado.show();
}