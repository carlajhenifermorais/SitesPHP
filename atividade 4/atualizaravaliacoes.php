<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);
$idx = 1;

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];
    $turma = $_GET["turma"];
    $descricao = $_GET["desc"];
    $peso = $_GET["peso"];
}else{
    $id = $_POST["id"];
    $novo_turma = $_POST["turma"];
    $novo_descricao = $_POST["desc"];
    $novo_peso = $_POST["peso"];
    

    $sql->query("UPDATE avaliacoes SET turma_id='$novo_turma', descricao ='$novo_descricao', peso ='$novo_peso' WHERE id = $id");
    header("Location: avaliacoes.php");
    exit();
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar">
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <div class="card">
                <h5 class="card-header bg-dark text-light">Avaliacoes</h5>
                <div class="card-body">
                    <form action="atualizaravaliacoes.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Turma</p>
                        <input type="number" name="turma" value="<?php echo $turma?>" style="width:100%">
                        <hr>
                        <p class="card-text">Descrição</p>
                        <input type="text" name="desc" value="<?php echo $descricao?>" style="width:100%">
                        <hr>
                        <p class="card-text">Peso</p>
                        <input type="float" name="peso" value="<?php echo $peso?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="avaliacoes.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
