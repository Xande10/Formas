
<!DOCTYPE html>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../classes/Usuario.class.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $aviso = "";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body style="background-color:darkcyan">
    <?php include_once "../menu.php";?>
    <center><h1>Login</h1></center>
    <content>
    <br>
        <form action="login.usuario.php?acao=login" method="post" id="form" class="row row-cols-lg-auto g-3 align-items-center" >
        <br>
            <div class="mx-auto">
                <div class="col-auto">
                    <div class="input-group">    
                        <div class="input-group-text border border-dark border border-2">Login:</div>
                        <input required type="text" class="form-control border border-dark border border-2" name="login" id="login">
                    </div>
                </div>
                <br>
                <div class="col-auto">
                    <div class="input-group">    
                        <div class="input-group-text border border-dark rounded-start">Senha:</div>
                        <input required type="password" class="form-control-sm border border-dark rounded-end" name="senha" id="senha">
                    </div>
                </div>
                <br>
                <button type="submit"  name="submit" id="submit" value="true" class="btn btn-dark border border-dark border border-2">Logar</button>
            </div>
        </form>
        <?php
            error_reporting(0);
            if($_GET['acao'] == 'login'){
                $usu = new Usuario("","","","");
                if ($usu->Login($login, $senha) == true){
                    $aviso = "<br><h3><center>Logado no sistema!</center></h3>"; 
                    echo $aviso;
                    header("location:login.usuario.php");
                } else {
                    $aviso = "<br><h3><center>Informações invalidas</center></h3>";
                    echo $aviso;
                }
            } 
        ?>   
    </content>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>