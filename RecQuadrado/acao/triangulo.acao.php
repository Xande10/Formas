<?php

    //abre conexão com o banco de dados
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    //chama a classe Triangulo
    require_once "../classes/Triangulo.class.php";

    //define as variaveis
    $L1 = isset($_POST['lado1']) ? $_POST['lado1'] : 0;
    $L2 = isset($_POST['lado2']) ? $_POST['lado2'] : 0;
    $L3 = isset($_POST['lado3']) ? $_POST['lado3'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $idtabuleiro = isset($_POST['idtabuleiro']) ? $_POST['idtabuleiro'] : 0;

    $acao = "";
    //verifica se acao for pego por $_POST ou por $_GET
    if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}

    //faz a verificação de qual comando foi escolhido
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        //se excluir for escolhido, cria-se um novo objeto que é igualado a uma variável
        $tri = new Triangulo($id, "", "", "","","");
        $tri->excluir();
         
        header("location:../triangulo/listar.triangulo.php");
    }

    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($id == 0){
            $tri = new Triangulo("", $_POST['cor'],$_POST['idtabuleiro'], $_POST['lado1'],$_POST['lado2'],$_POST['lado3']);
            $tri->salvar();

            
            header("location:../triangulo/listar.triangulo.php");
        }else {
            $tri = new Triangulo($_POST['id'], $_POST['cor'], $_POST['idtabuleiro'], $_POST['lado1'], $_POST['lado2'], $_POST['lado3']);
            $tri->editar();
        }    
        header("location:../triangulo/listar.triangulo.php");  
    }

?>