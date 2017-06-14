$(function(){
    if(findGetParameter("success")){
        $("#divResultado").addClass("alert alert-success alert-dismissable");
        $("#divResultado").append('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        $("#divResultado").append('Auto agregado con exito');
    }
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
    $("#btnIngresarAuto").hide();
    $.ajax({
        url:"APIREST/Cocheras/libres",
        method: "GET",
        dataType: "json",
        async: true
    }).done(function(result){
        alert(JSON.stringify(result));
        var div = $("#divListado");
        if(result == undefined || result.length == 0){
            div.html("No hay cocheras vacias");
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
                cuerpoTabla += '<td><button class="btn btn-success" onclick="IngresarAuto('+result[i]["id"]+')">Agregar</button></td>';
                cuerpoTabla += '</tr>';
            }
            cuerpoTabla += '</tbody></table>';
            div.html(encabezadoTabla + cuerpoTabla);
            div.show();
        }
    });
}

function DatosCochera(){
    var encabezadoTabla = '<div class="table-responsive"><table class=table>';
            encabezadoTabla += '<thead><tr>';
            encabezadoTabla += '<th colspan="2">Cochera</th><th colspan="3">Auto</th><th colspan="2">Empleado</th><th colspan="2">Fecha</th><th>Importe</th>';
            encabezadoTabla += '</tr><tr>';
            encabezadoTabla += '<th>Piso</th><th>Numero</th><th>Patente</th><th>Marca</th><th>Color</th><th>Nombre</th><th>Apellido</th><th>Fecha Ingreso</th><th>Fecha Salida</th><th>&nbsp;</th>';
            encabezadoTabla += '</tr></thead>';
}