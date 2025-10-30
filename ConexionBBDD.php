<?php 
    //Cargo el archivo autoload.php para cargar las liberias
    require_once __DIR__ . "/vendor/autoload.php";

    //Cargo el Dotenv
    //!siempre se tiene que cargar despues de el require/include
    use Dotenv\Dotenv;

    //Cargo el .env (en este caso pongo solo __DIR__ ya que el .env esta en la misma carpeta que el .php)
    $dotenv = Dotenv::createImmutable(__DIR__); 
    $dotenv->load();
    /**
     * Clase para conectase a la base de datos
     * 
     * @author Carlos Esteban Diez 2 Daw
     * @param $user Usuario para conectarse a la bbdd
     * @param $password Contraseña para conectarse
     * @param $db Nombre de la base de datos
     * @param $service Servicio de la base de datos o el puerto al que se conecta
     * @param $conexion Variable donde se guarda la conexion pdo
     */


    class Conexion {
        //Si lo haces privado y estatico solo tiene
        private $user;
        private $password;
        private $db;
        private $service;
        private $conexion;

        public function __construct() {
            //Me saco el usuario, password, db y servicio del .env
            $this->user = $_ENV["USER"];
            $this->password = $_ENV["PASS"];
            $this->db = $_ENV["DB"];
            $this->service = $_ENV["SERVICE"];

            //Me cargo el el sql
            $this->cargarSql();

            //Me hago la conexion a la base de datos correcta
            $this->conectarse();
        }

        /** 
         * Esta funcion me conectara a mi servidor mysql pero no a la base de datos 
         * Despues cojera y me ejecutara el sql creando la base de datos indicada en el .sql
         */
        private function cargarSql (){
            try{
                //me hago una conexion para cargar el sql temporal
                $conexionTemp = new PDO("mysql:host=". $this->service, $this->user, $this->password);
                //Pongo los errores y excepciones
                $conexionTemp-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Saco la ruta al .sql
                $archivoSQL = __DIR__ . '/resources/marcador_v2.sql';
                
                //Compruebo que exista el .sql
                if (!file_exists($archivoSQL)){
                    echo "Archivo .sql no encontrado";
                }
                else {
                    //Saco los datos del .sql
                    $contenidoSQL = file_get_contents($archivoSQL);
                    //Ejecuto lo que hay en el sql
                    $conexionTemp->exec($contenidoSQL);

                    $conexionTemp = null;
                }
            } catch (PDOException $e){
                echo "Error la conectarser a la base de datos <br/>" . $e;
            }
        }

        /**
         * Funcion para conectarse a la base de datos
         * Importante hacer esta conexion despues de cargar el script .sql ya que si no dará error 
         * No encontrara la base de datos en caso de que no existiese
         * 
         * @return Devuelve la conexion a la base de datos
         */
        public function conectarse(){
            try {
                //Me hago la conexion y pongo los errores
                $conexion = new PDO ("mysql:host=". $this->service . ";dbname=". $this->db, $this->user, $this->password);
                $conexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //devuelvo esta conexion 
                return $conexion;

            } catch (PDOException $e){
                echo "Error la conectarser a la base de datos <br/>" . $e;
            }
        }

        /** 
         * Funcion que devuelve la conexion a la base de datos
        */
        public function getConexion(){
            return $this->conexion;
        }

        public function cerrarConexion(){
            $this->conexion = null;
        }
    }
?>