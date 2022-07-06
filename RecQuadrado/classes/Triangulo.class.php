<?php 

    require_once 'Forma.class.php';

    class Triangulo extends Forma{
        private $L1;
        private $L2;
        private $L3;


        public function __construct($id, $cor, $tabuleiro, $L1, $L2, $L3){
            parent::__construct($id,$cor, $tabuleiro);
            $this->setL1($L1);
            $this->setL2($L2);
            $this->setL3($L3);
        }

        public function getL1(){
            return $this->L1;
        }

        public function getL2(){
            return $this->L2;
        }

        public function getL3(){
            return $this->L3;
        }

        public function setL1($L1){
            $this->L1 = $L1;
        }

        public function setL2($L2){
            $this->L2 = $L2;
        }

        public function setL3($L3){
            
            $this->L3 = $L3;
        }

        public function __toString(){
            $str = parent::__toString();
            $str .= "Lado 1: ".$this->getL1()."<br>".
                    "Lado 2: ".$this->getL2()."<br>".
                    "Lado 3: ".$this->getL3()."<br>".
                    "Tipo: ".$this->tipoTriangulo()."<br>";
            return $str;
        }

        public function salvar(){
            $sql = 'INSERT INTO recuperacao.triangulo (cor, idtabuleiro, lado1, lado2, lado3) 
            VALUES(:cor, :idtabuleiro, :lado1, :lado2, :lado3)';
            //adiciona parâmetros
            $parametros = array(":cor"=>$this->getCor(), 
                                ":idtabuleiro"=>$this->getTabuleiro(),
                                ":lado1"=>$this->getL1(),
                                ":lado2"=>$this->getL2(),
                                ":lado3"=>$this->getL3());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            //monta sql - comando para deletar os dados
            $sql = 'DELETE FROM recuperacao.triangulo WHERE id = :id';
            //adiciona parâmetros
            $parametros = array(":id"=>$this->getId());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            //monta sql - comando para deletar os dados
            $sql = 'UPDATE recuperacao.triangulo 
            SET cor = :cor, idtabuleiro = :idtabuleiro, lado1 = :lado1, lado2 = :lado2, lado3 = :lado3
            WHERE id = :id';
            //adiciona parâmetros
            $parametros = array(":cor"=>$this->getCor(),
                                ":idtabuleiro"=>$this->getTabuleiro(),
                                ":id"=>$this->getId(),
                                ":lado1"=>$this->getL1(),
                                ":lado2"=>$this->getL2(),
                                ":lado3"=>$this->getL3());
            return parent::executaComando($sql,$parametros);
            
        }

        public function tipoTriangulo(){
            if($this->getL1() == $this->getL2() && $this->getL2() == $this->getL3()){
                return "Equilátero";
            }elseif($this->getL1() == $this->getL2() || $this->getL1() == $this->getL3() || $this->getL2() == $this->getL3()){
                return "Isóceles";
            }else{
                return "Escaleno";
            }
        }

        public function Area() {
            $area = sqrt(($this->L1+$this->L2+$this->L3)*(-$this->L1+$this->L2+$this->L3)*($this->L1-$this->L2+$this->L3)*($this->L1+$this->L2-$this->L3))/4;
            return $area;
        }
        
        public function Perimetro() {
            $perimetro = $this->L1 + $this->L2 + $this->L3;
            return $perimetro;
        }

        public function tipo(){
            if($this->getl1() == $this->getl2() && $this->getl2() == $this->getl3()){
                return "equilátero";
            }elseif($this->getl1() == $this->getl2() || $this->getl1() == $this->getl3() || $this->getl2() == $this->getl3()){
                return "isóceles";
            }else{
                return "escaleno";
            }
        }

        public function desenhar(){
            $str = "<div style='width: 0px; height: 0px; border-left: ".$this->L1."vh solid transparent; border-right: ".$this->L2."vh solid transparent;border-bottom: ".$this->L3."vh solid ".parent::getcor().";'></div><br>";
            return $str;
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM recuperacao.triangulo";
            //estrutura a busca por dados especificos (pesquisa)
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id LIKE :procurar"; $procurar = "%".$procurar."%";break;
                    case(2): $sql .= " WHERE lado1 LIKE :procurar"; $procurar.="%";  break;
                    case(3): $sql .= " WHERE lado2 LIKE :procurar"; $procurar.="%";  break;
                    case(4): $sql .= " WHERE lado3 LIKE :procurar"; $procurar.="%";  break;
                    case(5): $sql .= " WHERE cor LIKE :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE idtabuleiro LIKE :procurar"; $procurar = "%".$procurar."%";  break;
                }
                //adiciona parâmetros
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql,$parametros);
        }
    
    }

        /*public function perimetro(){
            return sqrt(pow($this->L1,2) + pow($this->L2 / 2, 2)) * 2 + $this->L2;
        }

        public function area(){
            return ($this->L2 * $this->L1) / 2;
        }


    public funciton triangulo() {
    int a, b, c;

    printf("Digite tres valores: ");
    scanf("%d%d%d", &a, &b, &c);

    if(a + b > c && a + c > b && b + c > a){
        printf("Os 3 lados formam um triangulo!\n");
        if(a == b && a == c)
            printf("Equilatero\n");
        else
            if(a == b || a == c || b == c)
                printf("Isosceles\n");
            else
                printf("Escaleno\n");
    }
    else
        printf("Os 3 lados NAO formam um trinagulo!\n");
    } */

?>

