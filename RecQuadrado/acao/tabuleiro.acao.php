<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../classes/Tabuleiro.class.php";

    $acao = "";
    if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}
        
    if ($acao == "excluir"){
        $idtabuleiro = isset($_GET['idtabuleiro']) ? $_GET['idtabuleiro'] : 0;
        
        $tab = Tabuleiro::excluir($idtabuleiro);
        header("location:../tabuleiro/listar.tabuleiro.php");
    }

    if ($acao == "salvar"){
        $id = isset($_POST['idtabuleiro']) ? $_POST['idtabuleiro'] : "";
        if ($id == 0){
            $tab = Tabuleiro::salvar($_POST['lado']);      
            
            header("location:../tabuleiro/listar.tabuleiro.php");
        }else{
            $tab = Tabuleiro::editar($_POST['idtabuleiro'], $_POST['lado']);
            
        }    
        header("location:../tabuleiro/listar.tabuleiro.php");  
    }

?>