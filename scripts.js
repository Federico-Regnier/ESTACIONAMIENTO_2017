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
});