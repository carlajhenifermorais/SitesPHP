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
    $curso = $_GET["curso"];
    $duracao = $_GET["dura"];
}else{
    $id = $_POST["id"];
    $novo_curso = $_POST["curso"];
    $novo_duracao = $_POST["duracao"];

    $sql->query("UPDATE cursos SET nome='$novo_curso', duracao_semestres='$novo_duracao' WHERE id = $id");
    header("Location: cursos.php");
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
                <h5 class="card-header bg-dark text-light">Cursos</h5>
                <div class="card-body">
                    <form action="atualizarcursos.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Nome</p>
                        <input type="text" name="curso" value="<?php echo $curso?>" style="width:100%">
                        <hr>
                        <p class="card-text">Duração</p>
                        <input type="text" name="duracao" value="<?php echo $duracao?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="cursos.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
