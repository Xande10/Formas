<!DOCTYPE html>
<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "../acao/tabuleiro.acao.php";
    require_once "../classes/Tabuleiro.class.php";


    $title = "Tabela Tabuleiro";
    $lado = isset($_POST["lado"]) ? $_POST["lado"] : "";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : 0;

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <title><?php echo $title ?></title>
        <script>
            function excluirRegistro(url){
                if (confirm("Confirma Exclusão?"))
                    location.href = url;
            }
        </script>
    </head>
    <body>
        <?php 
            include_once "../menu.php";
        ?>
        <fieldset>
            <form method="post">
                <h3>Procurar Por:</h3>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="buscar" id="inlineRadio1" value="1" <?php if ($buscar == "1") echo "checked" ?>>
                <label class="form-check-label" for="inlineRadio1">ID</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="buscar" id="inlineRadio2" value="2" <?php if ($buscar == "2") echo "checked" ?>>
                <label class="form-check-label" for="inlineRadio2">Lado</label>
            </div>
                <h3>Procurar Tabuleiro:</h3>
                    <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>">
                <br><br>
                    <button name="acao" id="acao" type="submit" >Procurar</button>
                <br><br>
            </form>
        </fieldset>
        <div>
            <table class="table table-success table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">  #ID  </th> 
                        <th scope="col">  Lado  </th>
                        <th scope="col">  Mostrar Quadrado  </th>
                        <th scope="col">  Excluir  </th>
                        <th scope="col">  Editar  </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tab = new Tabuleiro("", "");
                    $lista = $tab->listar($buscar, $procurar);
                    foreach ($lista as $linha){ 
                    ?>
                    <tr>
                        <td scope="row"><?php echo $linha['idtabuleiro'];?></td>
                        <td scope="row"><?php echo $linha['lado'];?></td>
                        <td scope="row"><a href="mostrar.tabuleiro.php?idtabuleiro=<?php echo $linha["idtabuleiro"];?>&lado=<?php echo $linha["lado"];?>"><img src="../img/square.svg" alt=""></a></td>
                        <td scope="row"><?php echo "<a href=javascript:excluirRegistro('../acao/tabuleiro.acao.php?acao=excluir&idtabuleiro={$linha['idtabuleiro']}')>";?><img src="../img/trash.svg" alt=""></a></td>
                        <td scope="row"><a href="formulario.tabuleiro.php?acao=editar&idtabuleiro=<?php echo $linha['idtabuleiro'];?>"><img src="../img/editar.svg" alt=""></a></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>