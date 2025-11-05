<?php 
    session_start();

    require_once __DIR__ . "/Marcadores.php";

    $conexionBBDD = new Conexion();
    $conexion = $conexionBBDD->getConexion();

    $contenedorMarcador = new Marcadores($conexion);

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["nick"])){
            //guardo los datos
            $puntuacion = $_SESSION["puntuacion"];
            $nick = $_POST["nick"];

            //Me los meto en la db pasadno puntaucion a int y el nick solo las 3 primeras letras 
            $contenedorMarcador->insertarDatos((int)$puntuacion, substr($nick, 0, 3));

            //Me voy a index.php
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para meter nick</title>
</head>
<body>
    <div class="formulario">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nick">Introduce el nick: </label>
            <input type="text" name="nick" id="nikc">

            <button type="submit">Enviar Nick</button>
        </form>
    </div>
</body>
</html>