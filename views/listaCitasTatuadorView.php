<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        foreach ($citastat as $cita) {

            echo "<p>ID: ".$cita["id"]."</p>";
            echo "<p>Descripción: ".$cita["descripcion"]."</p>";
            echo "<p>Fecha Cita: ".$cita["fecha_cita"]."</p>";
            echo "<p>Cliente: ".$cita["cliente"]."</p>";
            echo "<p>Tatuador: ".$cita["tatuador"]."</p>";
            echo "<br>";

        }

    ?>
</body>
</html>