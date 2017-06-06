$(function(){
    $("#divContenido").on('click', "#editLink", function(event){
        event.preventDefault();
        var baja = $(this).parent().parent().data("baja");
        var mensaje;
        if(baja == 0){
            var datos = {"Suspender" : true, "id" : $(this).data("id")};
            mensaje = "Esta seguro que desea suspender al usuario?";
           
        } else{
            var datos = {"Habilitar" : true, "id" : $(this).data("id")};
            mensaje = "Esta seguro que desea habilitar al usuario?";
        }
        $("#myModal .modal-body").html(mensaje);
        $("#myModal").modal('show');
        $("#acceptModal").click(function(){
            $("#myModal").modal('hide');
            $.ajax({
                url: "administrador.php",
                data: datos,
                method: 'POST',
                async: true
            }).done(function(result){
                if(result != "error"){
                    $("#divContenido").load("test.php #divContenido");
                } else{
                    alert("No se pudo suspender el usuario");
                }
            });
        });
        
    });
});