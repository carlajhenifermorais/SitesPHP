<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "bdescola",
    3306
);
$idx = 1;

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];
    $matricula = $_GET["matri"];
    $avaliacao = $_GET["ava"];
    $valor = $_GET["valor"];
}else{
    $id = $_POST["id"];
    $novo_matricula = $_POST["matri"];
    $novo_avaliacao = $_POST["ava"];
    $novo_valor = $_POST["valor"];
    
    

    $sql->query("UPDATE notas SET matricula_id='$novo_matricula', avaliacao_id ='$novo_avaliacao', valor_nota='$novo_valor' WHERE id = $id");
    header("Location: notas.php");
    exit();
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <div class="card">
                <h5 class="card-header bg-dark text-light">Notas</h5>
                <div class="card-body">
                    <form action="atualizarnotas.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Matrícula</p>
                        <input type="number" name="matri" value="<?php echo $matricula?>" style="width:100%">
                        <hr>
                        <p class="card-text">Avaliação</p>
                        <input type="number" name="ava" value="<?php echo $avaliacao?>" style="width:100%">
                        <hr>
                        <p class="card-text">Valor</p>
                        <input type="float" name="valor" value="<?php echo $valor?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="notas.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
