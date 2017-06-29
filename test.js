$(function(){
    
});

function TraerEstadisticas(){
    $.ajax({
        url: "test.php",
        data: {"inicio": $("#fechaInicio").val(), "fin": $("#fechaFinal").val()},
        method: 'GET'
    }).done(function(result){
        alert(result);
    });
}