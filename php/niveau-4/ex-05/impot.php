<?php

    class impot{

        public $name;
        public $revenu;

        public function __construct($name, $revenu)
        {
            $this->name = $name;
            $this->revenu = $revenu;
            
        }

        public function __destruct()
        {
        }

        public function afficheImpot(){
            echo "Monsieur ".$this->name." votre impôt est de ".calculeImpot()." euros";
        }

        public function calculeImpot(){
            $impot;
            if($this->revenu<=15000){
                $impot = $this->revenu*15)/100;
            }else{
                $impot = $this->revenu*20)/100;
            }
            return $impot;
        }

    }

?>