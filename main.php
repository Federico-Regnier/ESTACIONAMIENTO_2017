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
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script src="scripts.js"></script>
    <style>
        body{
            padding-top: 70px;
        }
    </style>
    <title>Estacionamiento</title>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php">Estacionamiento</a>
        </div> <!--/ .navbar-header -->
        <div class="navbar-collapse collapse" id="navigationbar">
          <ul class="nav navbar-nav" id="navbar">
            <li class="active"><a href="main.php">Home</a></li>
            <li><a href="#" id="linkEmpleados">Empleados</a></li>
            <li><a href="#contact">Estadisticas</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Autos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Entrada</a></li>
                <li><a href="#">Salida</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" id="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/ .container -->
    </nav>
</head>
<body>
    <div class="container" id="divContenido">
        
    </div>
</body>
</html>