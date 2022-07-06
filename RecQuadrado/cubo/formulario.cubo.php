<?php

    // para criar um objetos
    // adicionar arquivo da classe
    /*include_once "../acao/Cubo.acao.php";
    require_once "../classes/Cubo.class.php";
    require_once "../conf/Conexao.php";
    include_once "../conf/default.inc.php";*/

    include_once "../classes/autoload.php";

    $id = null;
    if(isset($_GET['idcubo'])) {
        $id = $_GET['idcubo'];
        $cubo = new Cubo('','','');
        $lista = $cubo->listar(1, $id);
    }

    $title = "Cadastro de Cubo";
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $idquadrado = isset($_POST['idquadrado']) ? $_POST['idquadrado'] : 0;
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    
    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "salvar") {
        try{
            $cubo = new Cubo($id, $cor, "");
            $cubo->salvar();
            header("location:listar.cubo.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $cubo = new Cubo($id, $cor, $idcubo);
            $cubo->editar();
            header("location:listar.cubo.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $cubo = new Cubo( "", "",$idcubo);
            $cubo->excluir();
            header("location:listar.cubo.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>
<body style="background-color:darkcyan">
    <?php 
        include_once "../menu.php";
    ?>
    <fieldset> 
        <br>
        <center><h1>Cadastro de um Cubo</h1></center>
        <br>
        <form action="<?php if(isset($_GET['idcubo'])) { echo "listar.cubo.php?idcubo=$idcubo&acao=editar";} else {echo "listar.cubo.php?acao=salvar";}?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="mx-auto">
                <div class="col-12">
                    <input readonly type="hidden" name="idcubo" id="idcubo" value="<?php if (isset($id)) echo $lista[0]['idcubo'];?>">    
                    <br>
                    <div class="input-group">
                        <div class="input-group-text border border-dark border border-2">Cor</div>
                        <input class="form-control-color border border-dark border border-2" name="cor" id="cor" type="color" required="true" value="<?php if (isset($id)) echo $lista[0]['cor'];?>" >
                    </div>
                </div><br>
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text border border-dark border border-2">Id do Quadrado</div>
                        <select name="id" id="id" class="form-select border border-dark border border-2">
                            <?php
                                $pdo = Database::iniciaConexao();
                                $consulta = $pdo->query("SELECT * FROM quadrado;");
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option name="" value="<?php echo $linha['id'];?>"><?php echo $linha['id'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div><br><br>
                <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-dark border border-dark border border-2">Salvar</button>
            </div>
            </form>
            <br>
        </fieldset>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>