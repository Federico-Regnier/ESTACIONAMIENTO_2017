$(function(){
    // Para el highlight de la navbar
    var url = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
    $('#navbar li.active').removeClass('active');
    $("#navbar a").each(function(){
        if($(this).attr('href') == url){
            $(this).parent().addClass('active');
        }
    });

    $("#formEstadisticas").submit(function(event){
        event.preventDefault();
        TraerEstadisticas();
    });
});

function TraerEstadisticas(){
    $fechaInicio = $("#fechaInicio").val();
    $fechaFinal = $("#fechaFinal").val();
    
    $("#tablaEstadisticas").DataTable({
        "bFilter": false,
        "bDestroy": true,
        ajax: {
            url: 'APIREST/Cocheras/'+$fechaInicio+'/'+$fechaFinal,
            dataSrc: ''
        },
        columns: [
            { data: 'Piso'},
            { data: 'Numero'},
            { data: 'Patente'},
            { data: 'Marca'},
            { data: 'Color'},
            { data: 'Nombre'},
            { data: 'Apellido'},
            { data: 'Fecha_Ingreso'},
            { data: 'Fecha_Salida'},
            { data: 'Importe'}
        ]
    });
    
    $("#divResultado").show();
}