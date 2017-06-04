$(function(){
    $("#userForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "administrador.php",
            data: $("#userForm").serialize(),
            method: "POST",
            
        }).done(function(result){
            alert(result);
        });
    });

   $("#loginForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: "login.php",
            data: $("#loginForm").serialize(),
            method: "POST",
            
        }).done(function(result){
            if(result == "success"){
                window.location.replace("main.php");
            } else{
                var div = $("#divResultado");
                div.addClass("alert alert-danger");
                div.html(result);
            }
        });
    }); 
    
});