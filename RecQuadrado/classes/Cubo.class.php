<?php

    //abre conexão com o banco de dados
    include_once "../conf/Conexao.php";
    require_once "../conf/conf.inc.php";
    require_once "Quadrado.class.php";

    class Cubo extends Quadrado{
        private $idcubo;
        private $cor;

        public function __construct($id, $cor, $idcubo ){
            parent::__construct($id, '', '', '');
            $this->setIdCubo($idcubo);
            $this->setCor($cor);
        }

        public function setIdCubo($idcubo) {
            if ($idcubo > 0)
                return  $this->cubo = $idcubo ;
        }

        public function setCor($cor) {
            if ($cor > 0)
                return  $this->cor = $cor ;
        }

        Public function getIdCubo () {
            return  $this->cubo;
        }

        public function Area() {
            $area = 6 * pow(parent::getLado(),2);
            return $area;
        }

        public function Perimetro() {
            $perimetro = parent::getLado() * 12;
            return $perimetro;
        }

        public function __toString() {
            return  "[Cubo]<br>
                    Lado: ".$this->getLado()."<br>".
                    "Cor: ".$this->getCor()."<br>".
                    "Id do Tabuleiro: ".$this->getTabuleiro()."<br>".
                    "Area: ".$this->Area()."<br>".
                    "Perimetro: ".$this->Perimetro()."<br>".
                    "<br>";
        }

        public function salvar(){
            $sql = 'INSERT INTO cubo (idquadrado, cor) 
            VALUES(:idquadrado, :cor)';
            //adiciona parâmetros
            $parametros = array(":idquadrado"=>$this->getId(),
                                ":cor"=>$this->getCor());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            //monta sql - comando para deletar os dados
            $sql = 'DELETE FROM recuperacao.cubo WHERE idcubo = :idcubo';
            //adiciona parâmetros
            $parametros = array(":idcubo"=>$this->getIdCubo());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            //monta sql - comando para deletar os dados
            $sql = 'UPDATE recuperacao.cubo 
            SET cor = :cor, idquadrado = :idquadrado
            WHERE idcubo = :idcubo';
            //adiciona parâmetros
            $parametros = array(":idcubo"=>$this->getIdCubo(),
                                ":cor"=>$this->getCor(),
                                ":idquadrado"=>$this->getId());
            return parent::executaComando($sql,$parametros);
            
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM quadrado, cubo
            WHERE quadrado.id = cubo.idquadrado";
            //estrutura a busca por dados especificos (pesquisa)
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " && idcubo like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " && cubo.cor like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " && idquadrado like :procurar"; $procurar = "%".$procurar."%"; break;
                }
                //adiciona parâmetros
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        // Aproxima os quadrados, formando um cubo
        public function divisao(){
            return $this->getlado() / 2;
        }

        // Desenha o cubo a partir dos lados e cores do quadrado
        public function desenha(){
            $str = "<div style='width: ".$this->getlado()."px; height: "
                                        .$this->getlado()."px; animation: rotate 10s infinite alternate; transform-style: preserve-3d;'>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", "
                                        .$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: translateZ(".$this->divisao()."px);'>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", "
                                        .$this->getcor()."); border: 2px solid black; display: flex; width: "
                                        .$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateY(90deg) translateZ(".$this->divisao()."px);'>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", "
                                        .$this->getcor()."); border: 2px solid black; display: flex; width: "
                                        .$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateY(180deg) translateZ(".$this->divisao()."px);'>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", "
                                                .$this->getcor()."); border: 2px solid black; display: flex; width: "
                                                .$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateY(-90deg) translateZ(".$this->divisao()."px);'>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", "
                                        .$this->getcor()."); border: 2px solid black; display: flex; width: "
                                        .$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateX(90deg) translateZ(".$this->divisao()."px);'>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", "
                                        .$this->getcor()."); border: 2px solid black; display: flex; width: "
                                    .$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateX(-90deg) translateZ(".$this->divisao()."px);'>
                        </div>
                    </div><br><br><br>";
            return $str;
        }




    }

?>