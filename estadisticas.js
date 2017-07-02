$(function(){
    // Para el highlight de la navbar
    var url = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
    $('#navbar li.active').removeClass('active');
    $("#navbar a").each(function(){
        if($(this).attr('href') == url){
            $(this).parent().addClass('active');
        }
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

    $("#formEstadisticas").submit(function(event){
        event.preventDefault();
        TraerEstadisticas();
    });

});

function TraerEstadisticas(){
    var fechaInicio = $("#fechaInicio").val();
    var fechaFinal = $("#fechaFinal").val();
    
    if(fechaInicio == "" || fechaFinal == ""){
        alert("Debe ingresar un rango de fechas");
        return;
    }
    
    $("#tablaEstadisticas").DataTable({
        "bFilter": false,
        "bDestroy": true,
        "order": [[ 5, "asc"]],
        "language": {
            url:'dataTablesSpanish.json'
        },
        ajax: {
            url: 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Cocheras/'+fechaInicio+'/'+fechaFinal,
            dataSrc: ''
        },
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

    $.ajax({
        url: 'http://localhost/ESTACIONAMIENTO_2017/APIREST/Estadisticas/'+fechaInicio+'/'+fechaFinal,
        method: 'GET',
    }).done(function(result){
        var div = $("#estadisticasCocheras");
        div.html("");

        // Verifico que se haya usado alguna cochera
        if(!$.isEmptyObject(result["cocheraMasUsada"])){
            div.append("<h2>Cochera mas usada</h2>" + "Numero " + result["cocheraMasUsada"]["Numero"] + " piso " + result["cocheraMasUsada"]["Piso"]);
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
    });
    
    $("#divResultado").show();
}