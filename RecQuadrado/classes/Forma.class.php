<?php 
    //Super classe Forma que irá definir aquilo que é comum para todas as formas
    //Classe Pai
    require_once "Database.class.php";
    
    abstract class Forma extends Database{
        private $id;
        private $cor;
        private $tabuleiro;
        private static $contador = 0; // compartilhar entre todos os objetos

        //constrói a classe através das variáveis 
        public function __construct($id, $cor, $tabuleiro) {
            $this->setId($id);
            $this->setCor($cor);
            $this->setTabuleiro($tabuleiro);
            self::$contador = self::$contador + 1;
        }

        public function setId($id) {
            if ($id > 0)
                return  $this->id = $id ;
        }
        
        public function setCor($cor) {
            if (strlen($cor) > 0)
                return  $this->cor = $cor ;
        }

        public function setTabuleiro($tabuleiro) {
            if ($tabuleiro > 0)
                return  $this->tabuleiro = $tabuleiro ;
        }

        Public function getId () {
            return  $this->id;
        }

        Public function getCor(){
            return  $this->cor;
        }

        Public function getTabuleiro(){
            return  $this ->tabuleiro;
        }

        public function __toString() {
            return  "Id: ". $this->getId()."<br>".
                    "Cor: ".$this->getCor()."<br>".
                    "Id do Tabuleiro: ".$this->getTabuleiro()."<br>".
                    "Contador: ".self::$contador."<br>".
                    "<br>";
        }

        public abstract function desenhar();
        public abstract function Area();
        public abstract function Salvar();
        public abstract function editar();
        public abstract function excluir();
        public abstract static function listar($buscar = 0, $procurar = "");

    }

?>