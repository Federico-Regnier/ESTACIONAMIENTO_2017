$(function(){
    // Para el highlight de la navbar
    var url = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
    $('#navbar li.active').removeClass('active');
    $("#navbar a").each(function(){
        if($(this).attr('href') == url){
            $(this).parent().addClass('active');
        }
    });
    
    // Envia una peticion de logout al adminUsuarios
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
});

