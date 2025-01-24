<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CITA CORRECTA</h1>
    <h2>Detalles de su reserva:</h2>
    <p>Fecha y hora: <?= $fecha_cita?><p>
    <p>Cliente: <?= $cliente?><p>
    <p>Descripción: <?= $descripcion?></p>
    <p>Tatuador: <?= $tatuadorNombre?></p>
    <img src="<?= $tatuadorFoto?>"></img>
</body>
</html>