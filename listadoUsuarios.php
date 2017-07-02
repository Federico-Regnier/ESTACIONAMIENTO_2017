<?php require_once("checkSesionAdmin.php"); ?>
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
    <?php include_once("navbarAdmin.php"); ?>
    <title>Empleados</title>
</head>
<body>
    
<?php
require_once("cliente.php");

$resultado = Cliente::Execute("TraerUsuarios", array());
if($resultado["Status"] == "error"){
    echo "error";
    die();
}
?>

<div class="container" id="contenedor">
<div id="divContenido">
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
                                // Saltear el usuario que esta logueado
                                if($value["ID"] == $_SESSION["ID"])
                                    continue;
                            ?>
                            <tr data-baja="<?php echo $value["Baja"] ?>">
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
                                    <a href="infoEmpleado.php?id=<?php echo $value["ID"];?>" class="table-link" id="infoLink">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="#" class="table-link " id="editLink" onclick="editarUsuario(<?php echo $value["ID"];?>)">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="#" class="table-link danger" onclick="Borrar(<?php echo $value["ID"];?>)">
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
                    </table> <!--/ .user-list -->
                </div>  <!--/ .table-responsive -->
            </div> <!--/ .main-box-body -->
        </div> <!--/ .main-box -->
    </div> <!--/ .col -->
</div> <!--/ .row -->
</div>
</div> <!-- .container -->
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Modificar Datos del Empleado
                </h4>
            </div> <!-- .modal-header -->
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label"
                                for="nombre">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" 
                            id="id" placeholder="1" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label"
                                for="nombre">Usuario</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" 
                            id="usuario" placeholder="Usuario" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label"
                                for="nombre">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" 
                            id="nombre" placeholder="Nombre"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label"
                                for="apellido">Apellido</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" 
                            id="apellido" placeholder="Apellido"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                            for="dni" >DNI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                id="dni" placeholder="35444888"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <select class="form-control" id="estado" name="estado">
                                <option value="0">Activo</option>
                                <option value="1">Suspendido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="rol">
                        <div class="col-sm-offset-3 col-sm-9">
                            <label class="radio-inline"><input type="radio" name="rol" required value="1">Empleado</label>
                            <label class="radio-inline"><input type="radio" name="rol" required value="2">Administrador</label>
                        </div>
                    </div>
                </form>
            </div><!-- .modal-body -->
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Cerrar
                </button>
                <button type="button" class="btn btn-primary" onclick="modificarUsuario()">
                    Modificar
                </button>
            </div><!-- .modal-footer -->
        </div>
    </div>
</div> <!-- .modal -->
</body>
</html>