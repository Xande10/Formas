<?php 

    require_once('Forma.class.php');

    class Retangulo extends Forma{
        private $altura;
        private $base;


        public function __construct($id, $cor, $tabuleiro, $altura, $base){
            parent::__construct($id,$cor, $tabuleiro);
            $this->setAltura($altura);
            $this->setBase($base);
        }

        public function getAltura(){
            return $this->altura;
        }

        public function getBase(){
            return $this->base;
        }

        public function setAltura($altura){
            $this->altura = $altura;
        }

        public function setBase($base){
            $this->base = $base;
        }

        public function Area() {
            $area = $this->base * $this->altura;
            return $area;
        }

        public function Perimetro() {
            $perimetro = ($this->base * 2) + ($this->altura * 2);
            return $perimetro;
        }

        public function Diagonal() {
            $diagonal = sqrt(pow($this->base, 2) + pow($this->altura, 2));
            return $diagonal;
        }

        public function __toString() {
            return  "[Retângulo]<br>Id do Retangulo: ".$this->getId()."<br>".
                    "Altura: ".$this->getAltura()."<br>".
                    "Base: ".$this->getBase()."<br>".
                    "Cor: ".$this->getCor()."<br>".
                    "Área: ".round($this->Area(),2)."<br>".
                    "Perímetro: ".round($this->Perimetro(),2)."<br>".
                    "Diagonal: ".round($this->Diagonal(),2)."<br>".
                    "Id do Tabuleiro: ".$this->getTabuleiro()."<br>";
        }

        public function salvar(){
            $sql = 'INSERT INTO recuperacao.retangulo (cor, idtabuleiro, altura, base) 
            VALUES(:cor, :idtabuleiro, :altura, :base)';
            //adiciona parâmetros
            $parametros = array(":cor"=>$this->getCor(), 
                                ":idtabuleiro"=>$this->getTabuleiro(),
                                ":altura"=>$this->getAltura(),
                                ":base"=>$this->getBase());
            /*var_dump($parametros);
            die();*/
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            //monta sql - comando para deletar os dados
            $sql = 'DELETE FROM recuperacao.retangulo WHERE id = :id';
            //adiciona parâmetros
            $parametros = array(":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            //monta sql - comando para deletar os dados
            $sql = 'UPDATE recuperacao.retangulo 
            SET  cor = :cor, idtabuleiro = :idtabuleiro, altura = :altura, base = :base
            WHERE id = :id';
            //adiciona parâmetros
            $parametros = array(":cor"=>$this->getCor(),
                                ":idtabuleiro"=>$this->getTabuleiro(),
                                ":altura"=>$this->getAltura(),
                                ":base"=>$this->getBase(),
                                ":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
            
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM recuperacao.retangulo";
            //estrutura a busca por dados especificos (pesquisa)
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id LIKE :procurar"; $procurar = "%".$procurar."%";break;
                    case(2): $sql .= " WHERE altura LIKE :procurar"; $procurar.="%".$procurar."%";  break;
                    case(3): $sql .= " WHERE base LIKE :procurar"; $procurar.="%".$procurar."%"; break;
                    case(4): $sql .= " WHERE cor LIKE :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE idtabuleiro LIKE :procurar"; $procurar = "%".$procurar."%";  break;
                }
                //adiciona parâmetros
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql,$parametros);
        }

        public function desenhar(){
            $str = "<div style='width: ".$this->getAltura()."vh; height: ".$this->getBase()."vh; background: ".$this->getCor().";border: 5px solid;'></div><br>";
            return $str;
        }

    }

?>

