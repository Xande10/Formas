<?php

    //abre conexão com o banco de dados
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    //chama a classe Circulo
    require_once "../classes/Circulo.class.php";

    //define as variaveis
    $raio = isset($_POST['raio']) ? $_POST['raio'] : 0;
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $idtabuleiro = isset($_POST['idtabuleiro']) ? $_POST['idtabuleiro'] : 0;

    $acao = "";
    //verifica se acao for pego por $_POST ou por $_GET
    if(isset($_POST['acao'])){$acao = $_POST['acao'];}else if(isset($_GET['acao'])){$acao = $_GET['acao'];}

    //faz a verificação de qual comando foi escolhido
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        //se excluir for escolhido, cria-se um novo objeto que é iguaraio a uma variável
        $cir = new Circulo($id, "", "", "");
        $cir->excluir();
         
        header("location:../circulo/listar.circulo.php");
    }

    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($id == 0){
            $cir = new Circulo("", $_POST['raio'], $_POST['cor'],$_POST['idtabuleiro']);
            $cir->salvar();

            
            header("location:../circulo/listar.circulo.php");
        }else {
            $cir = new Circulo($_POST['id'], $_POST['raio'], $_POST['cor'], $_POST['idtabuleiro']);
            $cir->editar();
        }    
        header("location:../circulo/listar.circulo.php");  
    }

?>