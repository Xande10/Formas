<?php 

    class Database{

        public static function iniciaConexao(){
            require_once ("../conf/Conexao.php");
            return Conexao::getInstance();
        }

        public static function vinculaParametros($stmt, $parametros=array()){
            //vincular os parametros 
            foreach ($parametros as $chave=>$valor){

                $stmt->bindValue($chave, $valor);

            }
            return $stmt;
        }

        public static function executaComando($sql, $parametros=array()){
            $conexao = self::iniciaConexao();
            print_r($sql);
            $stmt = $conexao->prepare($sql);
            $stmt = self::vinculaParametros($stmt, $parametros);
            try{
                return $stmt->execute();
            } catch (Exception $e) {
                throw new Exception('Erro na execução do comando!');
            }
        }


    
        public function buscar($sql, $parametros=array()){
            $conexao = self::iniciaConexao();
            $stmt = $conexao->prepare($sql);
            $stmt = self::vinculaParametros($stmt, $parametros);
            $stmt->execute();
            return $stmt->fetchall();
        }

        /*public function listar($buscar = 0, $procurar = ""){
            //abrir conexao com o banco
            $pdo = Conexao::getInstance();
            //montar sql - comando para inserir os dados
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
                $stmt = $pdo->prepare($sql);
                if ($buscar > 0)
                    $stmt->bindValue(':procurar',$procurar,PDO::PARAM_STR);
            $stmt->execute();   
            return $stmt->fetchALL();
        }*/

    }

?>