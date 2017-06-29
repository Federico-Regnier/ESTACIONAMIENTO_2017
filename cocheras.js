$(function(){
    if(findGetParameter("success")){
        $("#divResultado").addClass("alert alert-success alert-dismissable");
        $("#divResultado").append('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        $("#divResultado").append('Auto agregado con exito');
    }
    $("#formSacarAuto").submit(function(event){
        event.preventDefault();
        SacarAuto();
    });
});

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
    .substr(1)
        .split("&")
        .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    });
    return result;
}

function TraerCocherasLibres(){
    var patente = $("#patente");
    var color = $("#color");
    var marca = $("#marca");
    var div = $("#divResultado");

    div.removeClass("alert alert-success") ;

    if(patente.val() == ""){
       div.addClass("alert alert-danger");
       div.html("Ingrese una patente valida");
       return ;
    }

    if(color.val() == ""){
        div.addClass("alert alert-danger");
        div.html("Ingrese un color valido");
        return ;
    }

    if(marca.val() == ""){
        div.addClass("alert alert-danger");
        div.html("Debe ingresar una marca");
        return ;
    }
    
    div.removeClass("alert alert-danger");
    div.html("");
    $("#btnIngresarAuto").hide();
    $.ajax({
        url:"APIREST/Cocheras/libres",
        method: "GET",
        dataType: "json",
        async: true
    }).done(function(result){
        var div = $("#divListado");
        if(result == undefined || result.length == 0){
            div.html("No hay cocheras libres");
        } else {
            var encabezadoTabla = '<table class=table>';
            encabezadoTabla += '<thead><tr>';
            encabezadoTabla += '<th>Piso</th><th>Numero</th><th>Reservada</th><th>&nbsp;</th>';
            encabezadoTabla += '</tr></thead>';

            var cuerpoTabla = '<tbody>';
            for(var i = 0; i < result.length; i++){
                cuerpoTabla += '<tr>';
                cuerpoTabla += '<td>'+result[i]["Piso"]+'</td>';
                cuerpoTabla += '<td>'+result[i]["Numero"]+'</td>';
                cuerpoTabla += '<td>';
                if(result[i]["Reservada"])
                    cuerpoTabla += 'Si</td>';
                else
                    cuerpoTabla += 'No</td>';
                cuerpoTabla += '<td><button class="btn btn-success" onclick="IngresarAuto('+result[i]["ID"]+')">Agregar</button></td>';
                cuerpoTabla += '</tr>';
            }
            cuerpoTabla += '</tbody></table>';
            div.html(encabezadoTabla + cuerpoTabla);
            div.show();
        }
    });
}

function IngresarAuto(id){
    var patente = $("#patente").val();
    patente = patente.replace(/\s/g,"").toUpperCase();
    var color = $("#color").val();
    var marca = $("#marca").val();
    var idUsuario = $("#btnIngresarAuto").data('user');
    
    $.ajax({
        url: 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Auto',
        method: 'POST',
        async: true,
        data: {"patente": patente, "marca": marca, "color": color,"idUsuario": idUsuario,"idCochera": id},
    }).done(function(result){
       if(result == "success"){
           window.location.href = "agregarAuto.php?success"
       }
    }).fail(function(result){
        console.log(result);
    });
}

function SacarAuto(){
    var patente = $("#patente").val();
    patente = patente.replace(/\s/g,"");
    var urlApi = 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Auto/' + patente;

    $.ajax({
        url: urlApi,
        method: 'PUT',
        async: true,
        data: {"patente": patente},
        dataType: "json"
    }).done(function(result){
        var divResultado = $("#divResultado");
        if(!$.isEmptyObject(result)){
            $("#divSacarAuto").hide();
            divResultado.removeClass();
            var html = '<div class="container">';
            html += '<ul class="list-group">';
            html +=  '<li class="list-group-item">'+result["Patente"]+'</li>';
            html += '<li class="list-group-item">'+result["Color"]+' '+result["Marca"]+'</li>';
            html += '<li class="list-group-item">'+"Piso "+result["Piso"]+" Cochera "+result["Numero"]+'</li>';
            html += '<li class="list-group-item">'+"Total: $"+ result["Importe"] +'</li>';
            html += '</ul> </div>';
            html += '<div class="container"><button type="button" class="btn btn-success" id="btnAceptar">Aceptar</button></div>'
            divResultado.html(html);
            divResultado.show();
            $("#btnAceptar").on('click', function(){
                window.location.href = "sacarAuto.php";
            });
        } else{
            divResultado.addClass("alert alert-danger col-xs-offset-0 col-sm-offset-4 col-lg-offset-4 col-xs-8 col-sm-5 col-lg-3 text-center");
            divResultado.html("Auto no encontrado");
            divResultado.show();
        } 
    }).fail(function(result){
        console.log(result);
        divResultado.addClass("alert alert-danger col-xs-offset-0 col-sm-offset-4 col-lg-offset-4 col-xs-8 col-sm-5 col-lg-3 text-center");
        divResultado.html("No se pudo conectar con la API");
        divResultado.show();
    });
}