<?php 
    //Importo Marcador.php y ConexionBBDD.php
    require_once __DIR__ . "/Marcador.php";
    require_once __DIR__ . "/ConexionBBDD.php";
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
            //Pongo lo conexion al la bbdd
            $this->conexion = $conexion;
            //inicializo la lista
            $this->listaMarcador = [];

            //Cargo los datos de la tabla topten al array
            $this->cargarDatos();
        }

        /**
         * Funcion que te carga los registro de la tabla topten de la base de datos al array
         */
        private function cargarDatos(){
            try{
                //hago la consulta y la ordeno ascendentemente
                $query = "SELECT pos, score, nick FROM topten ORDER BY pos ASC";
                foreach ($this->conexion->query($query) as $fila){
                    //Los valores numericos me los devuelve como int asi que no hace falta hacer una conversion de string a int
                    $marcador = new Marcador($fila["pos"], $fila["score"], $fila["nick"]);
                    
                    //Lo meto en el array
                    $this->listaMarcador[] = $marcador;
                }
                
            } catch (PDOException $e){
                echo $e;
            }
        }

        /**
         * Imprime las puntuaciones ordenadas en forma de tabla
         */
        public function imprimirPuntuaciones(){
            echo "<table>";
            echo "  <tr>
                        <th>Posicion</th>
                        <th>Puntuacion</th>
                        <th>Nick</th>
                    </tr>";
            foreach ($this->listaMarcador as $valor){
                echo "<tr>";
                echo "<td>" . $valor->getPosicion() ."</td>";
                echo "<td>" . $valor->getPuntuacion() . "</td>";
                echo "<td>" . $valor->getNick() . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
?>