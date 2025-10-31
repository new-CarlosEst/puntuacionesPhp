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
            //Cargo los datos de la tabla topten al array
            $this->cargarDatos();
        }

        /**
         * Funcion que te carga los registro de la tabla topten de la base de datos al array
         */
        private function cargarDatos(){
            try{
                //Me vacio el array para buscar las cosas
                $this->listaMarcador = [];
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


        /**
         * Funcion que me inserta una puntuacion y un nick y le pone una posicion
         * Si la puntacion no supera el top 10 no lo meto
         * Si lo supera mueve todos los registros con uan puntuacion menor una fila abajo y me pone el nuevo registro en su posicion correspondiente
         * 
         * @param $puntuacion Puntuacion a insertar
         * @param $nick Nick de el jugador que ha hecho esa puntuacion
         */
        public function insertarDatos($puntuacion, $nick){
            $posicion = $this->sacarPosicion($puntuacion);

            //Si es -1 es que no esta en el top 10, y si es mayor de 10 la posicion es que es igual la puntuacion que la del ultimo asi que tampoco lo inserto
            if ($posicion != -1 && $posicion <= 10){
                try {
                    //Me hago la sentencia
                    $sql = "UPDATE topten SET score = :puntuacion, nick = :nick WHERE pos = :pos";
                    $sentenciaPrep = $this->conexion->prepare($sql);

                    //Me lo recorro desde la ultima posicion hasta la posicion anterior donde va la puntuacion y el nick
                    for ($i = 10; $i > $posicion; $i--){
                        //Seleciono la posicion del array del de arriba.
                        // Ejemplo: cojo la puntucion y nick de la posicion 9 y los meto en la posicion 10, y asi hasta que llega a la posicion anterior a donde iria la puntuacion
                        $posArray = $i-2;

                        //me saco los datso de la fila de arriba
                        $puntuacionArriba =  $this->listaMarcador[$posArray]->getPuntuacion();
                        $nickArriba =  $this->listaMarcador[$posArray]->getNick();
                        //bindeo los parametros (Solo se puede pasar parametros)
                        $sentenciaPrep->bindParam(":pos", $i);
                        $sentenciaPrep->bindParam(":puntuacion", $puntuacionArriba);
                        $sentenciaPrep->bindParam(":nick", $nickArriba);

                        //La ejecuto
                        $sentenciaPrep->execute();
                    }

                    //ahora que tengo todos bajados una posicion me pongo la puntuacion y nick que habia metido en la posicion que le corresponde
                    $sentenciaPrep->bindParam(":pos", $posicion);
                    $sentenciaPrep->bindParam(":puntuacion", $puntuacion);
                    $sentenciaPrep->bindParam(":nick" , $nick);

                    $sentenciaPrep->execute();
                } catch (PDOException $e) {
                    echo $e;
                }

                //una vez hecho todo esto, cargo los datos nuevoe en el array
                $this->cargarDatos();
            }

        }

        /**
         * Funcion que saca la posicion en la que tiene que ir esa puntuacion
         */
        private function sacarPosicion($puntuacion){
            for($i = 0; $i < count($this->listaMarcador); $i++){

                //Calculo la puntuacion
                $operacion = $puntuacion - $this->listaMarcador[$i]->getPuntuacion();

                //Si no es mayor que 0 significa que la puntuacion introducida va en esa posicion
                //Despues en el update colocare ese nick y esa puntuacion en esa posicion y la que habia ahi los bajo una posicion y asi hasta que haga el top 10
                if ($operacion > 0){
                    return $i+1;
                }
                //Si es justo 0 significa que la puntuacion es igual, asi que lo colocare abajo de la posicion actual y a los que haya bajo los bajare una posicion abajo
                else if ($operacion == 0){
                    return $i + 2;
                }
            }

            return -1;
        }
        
    }
?>