<?php
    require_once __DIR__ . "/Marcadores.php";

    $conexionBBDD = new Conexion();
    $conexion = $conexionBBDD->getConexion();

    $contenedorMarcador = new Marcadores($conexion);

    $contenedorMarcador->imprimirPuntuaciones();

    $conexionBBDD->cerrarConexion();
?>