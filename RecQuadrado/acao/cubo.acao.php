<?php
/*

    //abre conexão com o banco de dados
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    //chama a classe Cubo
    require_once "../classes/autoload.php";

    //define as variaveis
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $idquadrado = isset($_POST['idquadrado']) ? $_POST['idquadrado'] : 0;

    $acao = "";
    //verifica se acao for pego por $_POST ou por $_GET
    if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}

    //faz a verificação de qual comando foi escolhido
    if ($acao == "excluir"){
        $id = isset($_GET['idcubo']) ? $_GET['idcubo'] : 0;
        
        //se excluir for escolhido, cria-se um novo objeto que é igualado a uma variável
        $cubo = new Cubo("", "",$id);
        $cubo->excluir();
         
        header("location:../cubo/listar.cubo.php");
    }

    if ($acao == "salvar"){
        $id = isset($_POST['idcubo']) ? $_POST['idcubo'] : 0;
        if ($id == 0){
            $cubo = new Cubo($_POST['idquadrado'],$_POST['cor'], '');
            $cubo->salvar();

            
            header("location:../cubo/listar.cubo.php");
        }else {
            $cubo = new Cubo($_POST['idquadrado'],$_POST['cor'], $_POST['idcubo'],);
            $cubo->editar();
        }    
        header("location:../cubo/listar.cubo.php");  
    }
*/
?>