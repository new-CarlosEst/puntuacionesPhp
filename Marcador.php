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

        public function __construct(?int $posicion, ?int $puntuacion, ?string $nick){
            $this->posicion = $posicion;
            $this->puntuacion = $puntuacion;
            $this->nick = $nick;
        }

        public function getPosicion(){
            return $this->posicion;
        }

        public function getPuntuacion(){
            return $this->puntuacion;
        }

        public function getNick(){
            return $this->nick;
        }

        public function __toString () : string {
            return $this->posicion . ";" . $this->puntuacion . ";" . $this->nick;
        }
    }
?>