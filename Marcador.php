<?php
    /**
     * Clase marcador con los atributos de la tabla topten
     * 
     * @author Carlos Esteban Diez 2 Daw
     * 
     * @param $posicion Posicion del jugador segun su puntuacion
     * @param $puntuacion puntuacion del jugador
     * @param $nick Nombre del jugador
     */
    class Marcador {
        private $posicion;
        private $puntuacion;
        private $nick;

        /**
         * Constructor que recibe la posicion, puntuacion y nick
         */
        public function __construct(?int $posicion, ?int $puntuacion, ?string $nick){
            $this->posicion = $posicion;
            $this->puntuacion = $puntuacion;
            $this->nick = $nick;
        }

        //Getters
        public function getPosicion(){
            return $this->posicion;
        }

        public function getPuntuacion(){
            return $this->puntuacion;
        }

        public function getNick(){
            return $this->nick;
        }

        //Setters
        public function setPosicion ($posicion){
            $this->posicion = $posicion;
        }

        public function setPuntuacion ($puntuacion){
            $this->puntuacion = $puntuacion;
        }

        public function setNick ($nick){
            $this->nick = $nick;
        }

        //To string para imprimir el objeto
        public function __toString () : string {
            return $this->posicion . ";" . $this->puntuacion . ";" . $this->nick;
        }
    }
?>