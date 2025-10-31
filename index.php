<?php
    require_once __DIR__ . "/Marcadores.php";

    $conexionBBDD = new Conexion();
    $conexion = $conexionBBDD->getConexion();

    $contenedorMarcador = new Marcadores($conexion);

    // $contenedorMarcador->insertarDatos(1580, "hol");
$contenedorMarcador->imprimirPuntuaciones();

    $conexionBBDD->cerrarConexion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica de puntuaciones</title>
</head>
<body>
    
</body>
</html>