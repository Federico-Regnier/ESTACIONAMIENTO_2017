$(function(){
    $("#formEstadisticas").submit(function(event){
        event.preventDefault();
        TraerEstadisticas();
    });

});

// Trae las estadisticas del API segun las fechas del formulario. 
// Si no se ingreso ninguna, trae todas
function TraerEstadisticas(){
    var fechaInicio = $("#fechaInicio").val();
    var fechaFinal = $("#fechaFinal").val();
    var urlEstadisticas = 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Estadisticas';
    
    if(fechaInicio != "" && fechaFinal != ""){
        urlEstadisticas += '/' + fechaInicio + '/'+ fechaFinal;
    }
    $.ajax({
        url: urlEstadisticas,
        method: 'GET',
        dataType: 'json',
        async: true
    }).done(function(result){
        $("#tablaEstadisticas").DataTable({
        "bDestroy": true,
        "order": [[ 5, "asc"]],
        "language": {
            url:'dataTablesSpanish.json'
        },
        data: result["Usadas"],
        columns: [
            { data: 'Piso'},
            { data: 'Numero'},
            { data: 'Patente'},
            { data: 'Marca'},
            { data: 'Color'},
            { data: 'Fecha_Ingreso'},
            { data: 'Fecha_Salida'},
            { data: 'Importe'}
        ]
        });
        
        var div = $("#estadisticasCocheras");
        div.html("");

        // Verifico que se haya usado alguna cochera
        if(!$.isEmptyObject(result["cocheraMasUsada"])){
            div.append("<h2>Cochera mas usada</h2>" + "Numero " + result["cocheraMasUsada"]["Numero"] + " piso " + result["cocheraMasUsada"]["Piso"]);
        }

        // Verifico que se haya usado alguna cochera
        if(!$.isEmptyObject(result["cocheraMenosUsada"])){
            div.append("<h2>Cochera menos usada</h2>" + "Numero " + result["cocheraMenosUsada"]["Numero"] + " piso " + result["cocheraMenosUsada"]["Piso"]);
        }

        // Verifico que haya cocheras sin usar
        if(result["cocherasSinUsar"].length > 0){
            div.append("<h2>Cocheras no usadas</h2>");
            var listado = '<ul class="list-group">';
            result["cocherasSinUsar"].forEach(function(element) {
                listado += '<li class="list-group-item">';
                listado += element["Numero"] + " Piso " + element["Piso"];
                listado += '</li>';
            }, this);
            listado += '</ul>';
            div.append(listado);
        }
        $("#divResultado").show();
    }).fail(function(result){
        $("#divContenido").prepend('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error al comunicarse con la API</div>');
    });
    
    
}