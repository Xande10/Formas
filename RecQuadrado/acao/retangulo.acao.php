<?php

    //abre conexão com o banco de dados
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    //chama a classe autoload
    require_once "../classes/autoload.php";

    //define as variaveis
    $altura = isset($_POST['altura']) ? $_POST['altura'] : 0;
    $base = isset($_POST['base']) ? $_POST['base'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $idtabuleiro = isset($_POST['idtabuleiro']) ? $_POST['idtabuleiro'] : 0;

    $acao = "";
    //verifica se acao for pego por $_POST ou por $_GET
    if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}

    //faz a verificação de qual comando foi escolhido
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        //se excluir for escolhido, cria-se um novo objeto que é igualado a uma variável
        $ret = new Retangulo($id, "", "", "","");
        $ret->excluir();
         
        header("location:../retangulo/listar.retangulo.php");
    }

    if ($acao == "salvar"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($id == 0){
            $ret = new Retangulo("", $_POST['cor'],$_POST['idtabuleiro'],$_POST['altura'], $_POST['base']);
            $ret->salvar();

            
            header("location:../retangulo/listar.retangulo.php");
        }else{
            $ret = new Retangulo($_POST['id'], $_POST['cor'],$_POST['idtabuleiro'],$_POST['altura'], $_POST['base']);
            $ret->editar();
        }    
        header("location:../retangulo/listar.retangulo.php");  
    }

?>