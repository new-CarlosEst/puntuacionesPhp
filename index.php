<?php
    require_once __DIR__ . "/Marcadores.php";

    $conexionBBDD = new Conexion();
    $conexion = $conexionBBDD->getConexion();

    $contenedorMarcador = new Marcadores($conexion);

    //Me inicializo 2 variable una que guardara lo de get y otra que guardara lo de post
    //Me inicializo datos get que contiene el nick como "---"
    $datosGet = "---";
    $datosPost = "";

    echo $_GET["nick"];
    //Solo si le paso nick por paremetro en la url
    if (isset($_GET["nick"])){
        //Saco las cosas del get
        $datosGet = $_GET["nick"];
    }
    //Con get no me lo esa cogiendo el nick asi compruebo si me lo esta cogiendo por parametro con el post 
    elseif (isset($_POST["nick"])){
        $datosGet = $_POST["nick"];
    }
    
    //Si el metodo es post saco lo de post 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        //Solo si envio el form con los  datos 
        if (isset($_POST["puntuacion"])){
            //Saco las cosas del formulario con post
            $datosPost = $_POST["puntuacion"];
        }
    }

    //Compruebo que la puntuacion sea numerica
    if (is_numeric($datosPost)){
        //paso a numero datosPost
        $datosPost = (int)$datosPost;

        if ($datosPost >= 0 ){
            $contenedorMarcador->insertarDatos($datosPost, $datosGet);
        }
        else {
            //Si no es mayor de 0 hago un alerta
            echo "<script> alert('La puntuacion no puede ser negativa')</script>";
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

    <div class="formulario">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="puntuacion">Introduce la puntuacion: </label>
            <input type="text" name="puntuacion" id="puntuacion">

            <button type="submit">Enviar Puntuacion</button>
        </form>
    </div>
</body>
</html>

<?php  $conexionBBDD->cerrarConexion(); //Cierro la conexion ?>
