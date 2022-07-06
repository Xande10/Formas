<?php

    //abre conexão com o banco de dados
    include_once "../conf/Conexao.php";
    require_once "../conf/conf.inc.php";
    require_once "Forma.class.php";

    //cria uma classe do objeto Quadrado
    class Quadrado extends Forma{
        private $id;
        private $lado;
        private $cor;
        private $idTabuleiro;
        private static $contador = 0; // compartilhar entre todos os objetos

        //constrói a classe através das variáveis 
        public function __construct($id, $lado, $cor, $idTabuleiro) {
            $this->setId($id);
            $this->setLado($lado);
            $this->setCor($cor);
            $this->setTabuleiro($idTabuleiro);
            self::$contador = self::$contador + 1;
        }
                
        public function setLado($lado) {
            if ($lado > 0)
                return  $this->lado = $lado ;
        }

        Public function getLado () {
            return  $this->lado;
        }

        public function Area() {
            //return $this->lado * $this->lado;
            $area = floatval($this->getLado()) * floatval($this->getLado());
            return $area;
        }

        public function Perimetro() {
            //return $this->lado * 4;
            $perimetro = floatval($this->getLado()) * 4;
            return $perimetro;
        }

        public function Diagonal() {
            //return $this->lado * sqrt(2);
            $diagonal = floatval($this->getLado()) * sqrt(2);
            return $diagonal;
        }
    
        public function __toString() {
            return  "[Quadrado]<br>Lado: ".$this->getLado()."<br>".
                    "Cor: ".$this->getCor()."<br>".
                    "Id do Tabuleiro: ".$this->getTabuleiro()."<br>".
                    "Area: ".$this->Area()."<br>".
                    "Perimetro: ".$this->Perimetro()."<br>".
                    "Diagonal: ".$this->Diagonal()."<br>".
                    "Contador: ".self::$contador."<br>".
                    "<br>";
        }

        public function salvar(){
            $sql = 'INSERT INTO recuperacao.quadrado (lado, cor, idtabuleiro) 
            VALUES(:lado, :cor, :idtabuleiro)';
            //adiciona parâmetros
            $parametros = array(":lado"=>$this->getLado(), 
                                ":cor"=>$this->getCor(), 
                                ":idtabuleiro"=>$this->getTabuleiro());
            /*var_dump($parametros);
            die();*/
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            //monta sql - comando para deletar os dados
            $sql = 'DELETE FROM recuperacao.quadrado WHERE id = :id';
            //adiciona parâmetros
            $parametros = array(":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            //monta sql - comando para deletar os dados
            $sql = 'UPDATE recuperacao.quadrado 
            SET lado = :lado, cor = :cor, idtabuleiro = :idtabuleiro
            WHERE id = :id';
            //adiciona parâmetros
            $parametros = array(":lado"=>$this->getLado(),
                                ":cor"=>$this->getCor(),
                                ":idtabuleiro"=>$this->getTabuleiro(),
                                ":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
            
        }

        //desenha o quadrado
        public function desenhar(){
            $str = "<div style='width: ".$this->getLado()."px; height: ".$this->getLado()."px; background: ".$this->getCor(). ";border: 7px solid;'></div>";
            return $str;
        }
    
        

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM recuperacao.quadrado";
            //estrutura a busca por dados especificos (pesquisa)
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id LIKE :procurar"; $procurar = "%".$procurar."%";break;
                    case(2): $sql .= " WHERE lado LIKE :procurar"; $procurar.="%";  break;
                    case(3): $sql .= " WHERE cor LIKE :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE idtabuleiro LIKE :procurar"; $procurar = "%".$procurar."%";  break;
                }
                //adiciona parâmetros
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql,$parametros);
        }

    }

?>