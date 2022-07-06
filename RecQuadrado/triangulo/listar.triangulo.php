<!DOCTYPE html>
<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "../acao/triangulo.acao.php";
    include_once "../classes/autoload.php";

    $title = "Tabela Triângulo";
    $L1 = isset($_POST['lado1']) ? $_POST['lado1'] : 0;
    $L2 = isset($_POST['lado2']) ? $_POST['lado2'] : 0;
    $L3 = isset($_POST['lado3']) ? $_POST['lado3'] : 0;
    $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : 0;

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <form method="post" >
            <h3>Pesquisar por:</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="buscar" id="inlineRadio1" value="1" <?php if ($buscar == "1") echo "checked" ?>>
                    <label class="form-check-label" for="inlineRadio1">ID</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="buscar" id="inlineRadio2" value="2" <?php if ($buscar == "2") echo "checked" ?>>
                    <label class="form-check-label" for="inlineRadio2">Lado 1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="buscar" id="inlineRadio2" value="2" <?php if ($buscar == "3") echo "checked" ?>>
                    <label class="form-check-label" for="inlineRadio2">Lado 2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="buscar" id="inlineRadio2" value="2" <?php if ($buscar == "4") echo "checked" ?>>
                    <label class="form-check-label" for="inlineRadio2">Lado 3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="buscar" id="inlineRadio3" value="3" <?php if ($buscar == "5") echo "checked" ?>>
                    <label class="form-check-label" for="inlineRadio3">Cor</label>
                </div>
                <h3>Procurar Triângulo:</h3>
                    <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>">
                <br><br>
                    <button class="btn btn-dark border border-dark border border-2" name="acao" id="acao" type="submit" >Procurar</button>
                <br><br>
            </form>
        </fieldset>
        <div>
            <table class="table table-success table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"> #ID </th>
                        <th scope="col"> Lado 1 </th>
                        <th scope="col"> Lado 2 </th>
                        <th scope="col"> Lado 3 </th>
                        <th scope="col"> Cor </th>
                        <th scope="col"> ID do Tabuleiro </th>
                        <th scope="col"> Mostrar Triângulo </th>
                        <th scope="col"> Excluir </th>
                        <th scope="col"> Editar </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tri = new Triangulo("", "", "","","","");
                    $lista = $tri->listar($buscar, $procurar);
                    foreach ($lista as $linha){ 
                    ?>
                    <tr>
                        <td scope="row"><?php echo $linha['id'];?></td>
                        <td scope="row"><?php echo $linha['lado1'];?></td>
                        <td scope="row"><?php echo $linha['lado2'];?></td>
                        <td scope="row"><?php echo $linha['lado3'];?></td>
                        <td scope="row"><?php echo $linha['cor'];?></td>
                        <td scope="row"><?php echo $linha['idtabuleiro'];?></td>
                        <td scope="row"><a href="mostrar.php?lado1=<?php echo $linha["lado1"];?>&lado2=<?php echo $linha["lado2"];?>&lado3=<?php echo $linha["lado3"]?>&cor=<?php echo str_replace('#', '%23', $linha['cor']);?>&idtabuleiro=<?php echo $linha["idtabuleiro"];?>"><img src="../img/square.svg" alt=""></a></td>
                        <td scope="row"><?php echo "<a href=javascript:excluirRegistro('../acao/triangulo.acao.php?acao=excluir&id={$linha['id']}')>"; ?><img src="../img/trash.svg" alt=""></a></td>
                        <td scope="row"><a href="formulario.triangulo.php?acao=editar&id=<?php echo $linha['id'];?>"><img src="../img/editar.svg" alt=""></a></td>
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