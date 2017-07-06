<?php
include_once("checkSesionAdmin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="scripts/scripts.js"></script>
    <script src="scripts/usuarios.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <script></script>
    <?php include_once("navbarAdmin.php");?>
    <title>Alta de Usuarios</title>
</head>
<body>
<div class="container well col-lg-offset-3 col-lg-5" id="divContenido">
    <div id="divResultado" class="col-sm-offset-3"></div>
    <div class="col-lg-10">
    <form class="form-horizontal" role="form" id="userForm">
        <h2 class="col-sm-offset-4 col-lg-offset-4"> Registrar Usuario</h2>
        <div class="form-group">
            <label for="usuario" class="col-sm-2 col-lg-3 control-label">Usuario</label>
            <div class="col-sm-9">
                <input type="text" name="usuario" placeholder="Usuario" class="form-control" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 col-lg-3 control-label">Contrase&ntilde;a</label>
            <div class="col-sm-9">
                <input type="password" name="password" placeholder="Contrase&ntilde;a" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="firstName" class="col-sm-2 col-lg-3 control-label">Nombre</label>
            <div class="col-sm-9">
                <input type="text" name="firstName" placeholder="Nombre" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="lastName" class="col-sm-2 col-lg-3 control-label">Apellido</label>
            <div class="col-sm-9">
                <input type="text" name="lastName" placeholder="Apellido" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="dni" class="col-sm-2 col-lg-3 control-label">DNI</label>
            <div class="col-sm-9">
                <input type="text" name="dni" placeholder="13555333" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="turno" class="col-sm-2 col-lg-3 control-label">Turno</label>
            <div class="col-sm-9">
                <select class="form-control" name="turno">
                    <option value="0">Ma&ntilde;ana</option>
                    <option value="1">Tarde</option>
                    <option value="2">Noche</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="rol">
            <div class="col-sm-offset-2 col-lg-offset-3 col-sm-9">
                <label class="radio-inline"><input type="radio" name="rol" required checked value="1">Empleado</label>
                <label class="radio-inline"><input type="radio" name="rol" required value="2">Administrador</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-2 col-lg-offset-3 ">
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </div>
        </div>
        
    </form> <!-- /form -->
    </div>
</div> <!-- ./container -->
</body>
</html>