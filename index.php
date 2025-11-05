<?php
    session_start();
    //Comiezo la sesion 

    //Destruyo y la borro solo si ya hay una activa
    if (!empty($_SESSION)) {
        session_unset();
        session_destroy();
    }

    
    require_once __DIR__ . "/Marcadores.php";

    $conexionBBDD = new Conexion();
    $conexion = $conexionBBDD->getConexion();

    $contenedorMarcador = new Marcadores($conexion);

    //Me inicializo 2 variable una que guardara lo de get y otra que guardara lo de post
    //Me inicializo datos get que contiene el nick como "---"
    $datosPost = "";
    
    //Miro si me lleva punt con get
    if (isset($_GET["punt"])){
        //Saco las cosas del get y lo meto en una variable
        $datosPost = $_GET["punt"];
        //Compruebo si es numerico y si es mayor o igual que 0
        if (is_numeric($datosPost) && $datosPost >= "0"){
            //Lo meto en la session y me voy al formualario de nick
            $_SESSION["puntuacion"] = $datosPost;
            header("Location: nick.php");
        }
        //si no hago un alert
        else {
            echo "<script> alert('Porfavor, solo pasar un entero mayor o igual que 0')</script>";
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica de puntuaciones</title>

    <style>
        *{
            margin: 3px;
        }
    </style>

</head>
<body>
    <div class="tabla">
        <?php 
            //imprimo las puntuaciones
            $contenedorMarcador->imprimirPuntuaciones();
        ?>
    </div>
</body>
</html>

<?php  $conexionBBDD->cerrarConexion(); //Cierro la conexion ?>
