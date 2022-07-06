<?php

    //abre conexão com o banco de dados
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    //chama a classe Quadrado
    require_once "../classes/Quadrado.class.php";

    //define as variaveis
    $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $idtabuleiro = isset($_POST['idtabuleiro']) ? $_POST['idtabuleiro'] : 0;

    $acao = "";
    //verifica se acao for pego por $_POST ou por $_GET
    if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}

    //faz a verificação de qual comando foi escolhido
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        //se excluir for escolhido, cria-se um novo objeto que é igualado a uma variável
        $quad = new Quadrado($id, "", "", "");
        $quad->excluir();
         
        header("location:../quadrado/listar.quadrado.php");
    }

    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($id == 0){
            $quad = new Quadrado("", $_POST['lado'], $_POST['cor'],$_POST['idtabuleiro']);
            $quad->salvar();

            
            header("location:../quadrado/listar.quadrado.php");
        }else {
            $quad = new Quadrado($_POST['id'], $_POST['lado'], $_POST['cor'], $_POST['idtabuleiro']);
            $quad->editar();
        }    
        header("location:../quadrado/listar.quadrado.php");  
    }

?>