$(function(){
    if(findGetParameter("success")){
        $("#divResultado").addClass("alert alert-success alert-dismissable");
        $("#divResultado").append('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        $("#divResultado").append('Auto agregado con exito');
    }
});

function AgregarAuto(idCochera, patente, color, marca){
alert(idCochera);
var datosAuto = {"Agregar" : true, 
                "ID": idCochera, 
                "Patente": patente, 
                "Color": color,
                "Marca": marca
            };
$.ajax({
    url: "adminCocheras.php",
    data: datosAuto,
    method: 'POST',
    async: true
}).done(function(result){
    alert(result);
    if(result == "success"){
        window.location.href = "index.php?success=true";
    } else{
        alert("Error al ingresar el auto. Intentelo mas tarde");
    }
    
});
}

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
