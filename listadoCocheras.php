<?php

include_once("checkSesion.php");
$resultado = Cochera::RetornarCocherasLibres();
?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Piso</th>
                    <th>Numero</th>
                    <th>Reservada</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultado as $value) {
                ?>
                <tr>
                    <td><?php echo $value["Piso"];?></td>
                    <td><?php echo $value["Numero"];?></td>
                    <td><?php echo $value["Reservada"] > 0? "Si" : "NO";?></td>
                    <td><button type="button" class="btn btn-success" onclick="AgregarAuto(<?php echo $value["ID"]; ?>,'<?php echo $_POST["patente"]?>','<?php echo $_POST["color"]?>','<?php echo $_POST["marca"]?>')">Agregar</button></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>



