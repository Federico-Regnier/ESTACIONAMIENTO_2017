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
    <script src="test.js"></script>
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
<div class="container" id="divContenido">
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
                                    <a href="#info" class="table-link" id="infoLink" data-id="<?php echo $value["ID"];?>">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="#" class="table-link " id="editLink" data-id="<?php echo $value["ID"];?>">
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

<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="acceptModal">Si</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>