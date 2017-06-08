<?
session_start();
if(!isset($_SESSION["ID"])){
    header('Location: login.html');
    die();
}
if($_SESSION["Rol"]!= 2){
    header('Location: index.php');
    die();
}

?>