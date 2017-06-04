<?php
require_once("cliente.php");

$resultado = Cliente::Execute("TraerUsuarios", array());

if($resultado["Status"] == "error"){
    echo "error";
    die();
}
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
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <title>Usuarios</title>
</head>
<body>
<div class="container">
    <div class="row" style="background: #EEE">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                    <th>Apellido</th>
                                    <th>Nombre</th>
                                    <th>DNI</th>
                                    <th>Estado</th>
                                    <th>Fecha de Creacion</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($resultado["Resultado"] as $value) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $value["Apellido"];?>
                                    </td>
                                    <td>
                                        <?php echo $value["Nombre"];?>
                                    </td>
                                    <td>
                                        <?php echo $value["DNI"];?>
                                    </td>
                                    <td>
                                        <?php echo $value["Baja"] == 0?  '<span class="label label-success">Activo' : '<span class="label label-danger">Suspendido';?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php echo $value["Fecha"];?>
                                    </td>
                                    <td style="width: 20%;">
                                        <a href="?info" class="table-link" id="<?php echo $value["ID"];?>">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                        <a href="?suspender" class="table-link" id="<?php echo $value["ID"];?>">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                        <a href="?borrar" class="table-link danger" id="<?php echo $value["ID"];?>">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <?php        
                                    }    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
</body>
</html>