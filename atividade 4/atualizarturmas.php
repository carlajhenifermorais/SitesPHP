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
    $ano = $_GET["ano"];
    $semestre = $_GET["sem"];
    $disciplina = $_GET["disc"];
    $professor = $_GET["prof"];
}else{
    $id = $_POST["id"];
    $novo_ano = $_POST["ano"];
    $novo_semestre = $_POST["sem"];
    $novo_disciplina = $_POST["disc"];
    $novo_professor = $_POST["prof"];
    

    $sql->query("UPDATE turmas SET ano_letivo='$novo_ano', semestre ='$novo_semestre', disciplina_id='$novo_disciplina', professor_id='$novo_professor' WHERE id = $id");
    header("Location: turmas.php");
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
                <h5 class="card-header bg-dark text-light">Turmas</h5>
                <div class="card-body">
                    <form action="atualizarturmas.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Ano</p>
                        <input type="number" name="ano" value="<?php echo $ano?>" style="width:100%">
                        <hr>
                        <p class="card-text">Semestre</p>
                        <input type="number" name="sem" value="<?php echo $semestre?>" style="width:100%">
                        <hr>
                        <p class="card-text">Disciplina</p>
                        <input type="number" name="disc" value="<?php echo $disciplina?>" style="width:100%">
                        <hr>
                        <p class="card-text">Professor</p>
                        <input type="number" name="prof" value="<?php echo $professor?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="turmas.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
