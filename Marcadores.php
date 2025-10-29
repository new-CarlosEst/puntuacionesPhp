<?php 
    //Importo Marcador.php y ConexionBBDD.php
    require_once "/Marcador.php";
    require_once "/ConexionBBDD.php";
    /**
     * Clase contendora de la clase Marcador
     * Esta clase contendra una lista con los datos de la tabla top ten en forma de objeto Marcador
     * Ademasa tendra metodos para hacaer inserts y consultas a la base de datos en concreto a la tabla topten
     * 
     * @author Carlos Esteban Diez
     * 
     * @param $listaMarcador Array con varios objetos Marcador
     * 
     * @param $Conexion Conexion a la base de datos donde sacare los datos
     */
    class Marcadores {
        private $listaMarcador;
        private $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        
    }
?>