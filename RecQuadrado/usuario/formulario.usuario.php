<?php

    // para criar um objetos
    // adicionar arquivo da classe
    include_once "../acao/usuario.acao.php";
    require_once "../classes/Usuario.class.php";
    require_once "../conf/Conexao.php";
    include_once "../conf/default.inc.php";

    $idusuario = null;
    if(isset($_GET['idusuario'])) {
        $idusuario = $_GET['idusuario'];
        $usu = new Usuario('','','','');
        $lista = $usu->listar(1, $idusuario);
    }

    $title = "Cadastro de usuário";
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    
    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    /*  if($acao == "salvar") {
            try{
                $quad = new Usuario('', $_POST['nome'], $_POST['login'], $_POST['senha']);
                $quad->inserir();
                header("location:cadUsuario.php");
            } catch(Exception $e) {
                echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
            }
        } else if($acao == "editar") {
            try{
                $quad = new Usuario($idusuario, $nome, $login, $senha);
                $quad->editar();
                header("location:cadUsuario.php");
            } catch(Exception $e) {
                echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
            }
        } else if($acao == "excluir") {
            try{
                $quad = new Usuario($idusuario, '','','');
                $quad->excluir($idusuario);
                header("location:cadUsuario.php");
            } catch(Exception $e) {
                echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
            }
        }
    */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title><?php echo $title ?></title>
    </head>
    <body style="background-color:darkcyan">
        <?php 
            include_once "../menu.php";
        ?>
        <fieldset> 
            <br>
            <center><h1>Cadastro de usuário</h1></center>
            <br>
            <form action="../acao/usuario.acao.php" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                    <div class="mx-auto">
                        <div class="col-12">
                            <input readonly type="hidden" name="idusuario" id="idusuario" value="<?php if (isset($idusuario)) echo $lista[0]['idusuario'];?>">    
                            <div class="input-group">
                                <div class="input-group-text border border-dark border border-2">Nome</div>
                                <input class="form-control border border-dark border border-2" type="text" name="nome" id="nome" placeholder="Insira o seu nome" value="<?php if (isset($idusuario)) echo $lista[0]['nome'];?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-text border border-dark border border-2">Login</div>
                                <input class="form-control border border-dark border border-2" name="login" id="login" type="text" required="true" placeholder="Insira o seu login" value="<?php if (isset($idusuario)) echo $lista[0]['login'];?>" >
                            </div>
                        </div>    
                        <br>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-text border border-dark border border-2">Senha</div>
                                <input class="form-control border border-dark border border-2" name="senha" id="senha" type="password" required="true" placeholder="Sua senha" value="<?php if (isset($idusuario)) echo $lista[0]['senha'];?>" >
                            </div>
                        </div>
                        <br>
                        <br>
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