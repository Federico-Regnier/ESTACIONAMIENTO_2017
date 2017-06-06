<?php
include_once("checkSesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
    <script></script>
    <?php include_once("navbarAdmin.php");?>
    <title>Alta de Usuarios</title>
</head>
<body>
<div class="container" id="divContenido">
    <div id="divResultado" class="col-sm-offset-3"></div>
    <form class="form-horizontal" role="form" id="userForm">
        <h2 class="col-sm-offset-5"> Registrar Usuario</h2>
        <div class="form-group">
            <label for="usuario" class="col-sm-3 control-label">Usuario</label>
            <div class="col-sm-9">
                <input type="text" name="usuario" placeholder="Usuario" class="form-control" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Contrase&ntilde;a</label>
            <div class="col-sm-9">
                <input type="password" name="password" placeholder="Contrase&ntilde;a" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" name="firstName" placeholder="Nombre" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="lastName" class="col-sm-3 control-label">Apellido</label>
            <div class="col-sm-9">
                <input type="text" name="lastName" placeholder="Apellido" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="dni" class="col-sm-3 control-label">DNI</label>
            <div class="col-sm-9">
                <input type="text" name="dni" placeholder="13555333" class="form-control" required>
            </div>
        </div>
        <div class="form-group" id="rol">
            <div class="col-sm-offset-3 col-sm-9">
                <label class="radio-inline"><input type="radio" name="rol" required checked value="1">Empleado</label>
                <label class="radio-inline"><input type="radio" name="rol" required value="2">Administrador</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </div>
        </div>
        
    </form> <!-- /form -->
</div> <!-- ./container -->
</body>
</html>