<?php
require_once("cliente.php");
require_once("checkSesion.php");
$resultado = Cliente::Execute("TraerUsuarios", array());

if($resultado["Status"] == "error"){
    echo "error";
    die();
}
?>
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
                                    <a href="#info" class="table-link" id="editLink" data-id="<?php echo $value["ID"];?>">
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
                                    <a href="javascript:void(0)" class="table-link danger" onclick="Borrar(<?php echo $value["ID"];?>)">
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