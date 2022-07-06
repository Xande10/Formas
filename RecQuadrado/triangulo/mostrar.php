<!DOCTYPE html>
<?php
    include_once "../classes/Triangulo.class.php";
    // include_once "classes/quadrado.class.php";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
    $idtabuleiro = isset($_GET['idtabuleiro']) ? $_GET['idtabuleiro'] : 0;
    $L1 = isset($_GET['lado1']) ? $_GET['lado1'] : 0;
    $L2 = isset($_GET['lado2']) ? $_GET['lado2'] : 0;
    $L3 = isset($_GET['lado3']) ? $_GET['lado3'] : 0;
?>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        .triangulo-para-cima {
        width: 0; 
        height: 0; 
        border-left: 25px solid transparent;
        border-right: 25px solid transparent;
        border-bottom: 25px solid #ff0000;
        }
    </style>

</head>
<body>
    <header>
        <?php include_once "../menu.php"; ?>
    </header>
    <center>
    <?php 

        $tri = new Triangulo($id, $cor, $idtabuleiro, $L1, $L2, $L3);
        echo $tri."<br>";
        echo $tri->desenhar();

    ?>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>