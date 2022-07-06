<?php

    //abre conexão com o banco de dados
    include_once "../conf/Conexao.php";
    require_once "../conf/conf.inc.php";

    //cria uma classe do objeto Tabuleiro
    class Tabuleiro{
        private $idtabuleiro;
        private $lado;

        //constrói a classe através das variáveis
        public function __construct($idtabuleiro, $lado) {
            $this->settabuleiro($idtabuleiro);
            $this->setLado($lado);
        }

        public function __toString() {
            return  "[tabuleiro]<br>Id: ".$this->getId()."<br>".
                    "Lado: ".$this->getlado()."<br>".
                    "Area: ".$this->Area()."<br>".
                    "Perimetro: ".$this->Perimetro()."<br>";
        }

        public function settabuleiro($idtabuleiro) {
            if ($idtabuleiro > 0)
                return  $this -> idtabuleiro = $idtabuleiro ;
        }
        
        
        public function setLado($lado) {
            if ($lado > 0)
                return  $this -> lado = $lado ;
        }


        Public function getId () {
            return  $this->idtabuleiro;
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
    

        public static function salvar($lado){
            //abrir conexao com o banco
            $pdo = Conexao::getInstance();
            //montar sql - comando para inserir os dados
            $stmt = $pdo->prepare('INSERT INTO recuperacao.tabuleiro (lado) VALUES (:lado)');
            //adicionar parâmetros
            $stmt->bindParam(':lado',$lado, PDO::PARAM_STR);
            return $stmt->execute();
        }

        public static function excluir($idtabuleiro){
            //abre conexao com o banco
            $pdo = Conexao::getInstance();
            //monta sql - comando para inserir os dados
            $stmt = $pdo->prepare('DELETE FROM recuperacao.tabuleiro WHERE idtabuleiro = :idtabuleiro');
            //adiciona parâmetros
            $stmt->bindParam(':idtabuleiro', $idtabuleiro, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public static function editar($idtabuleiro, $lado){
            //abre conexao com o banco
            $pdo = Conexao::getInstance();
            //monta sql - comando para inserir os dados
            $stmt = $pdo->prepare('UPDATE recuperacao.tabuleiro SET lado = :lado WHERE idtabuleiro = :idtabuleiro');
            //adiciona parâmetros
            $stmt->bindValue(':idtabuleiro', $idtabuleiro, PDO::PARAM_STR);
            $stmt->bindValue(':lado', $lado, PDO::PARAM_STR);
            return $stmt->execute();
        }

        // desenha a forma do quadrado
        public function desenhar(){
            $str = "<div style='width: ".$this->getLado()."px; height: ".$this->getLado()."px; border: 3px solid;'></div>";
            return $str;
        }

        public function listar($buscar = 0, $procurar = ""){
            //abrir conexao com o banco
            $pdo = Conexao::getInstance();
            //montar sql - comando para inserir os dados
            $sql = "SELECT * FROM recuperacao.tabuleiro";
            //estrutura a busca por dados especificos (pesquisa)
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idtabuleiro = :procurar"; break;
                    case(2): $sql .= " WHERE lado LIKE :procurar"; $procurar.="%"; break;
                }
                //adicionar parâmetros
                $stmt = $pdo->prepare($sql);
                if ($buscar > 0)
                    $stmt->bindValue(':procurar',$procurar,PDO::PARAM_STR);
            $stmt->execute();   
            return $stmt->fetchALL();
        }
    }

?>