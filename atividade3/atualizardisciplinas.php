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
    $nome = $_GET["nome"];
    $horas = $_GET["horas"];
    $curso = $_GET["curso"];
}else{
    $id = $_POST["id"];
    $novo_nome = $_POST["nome"];
    $novo_horas = $_POST["horas"];
    $novo_curso = $_POST["curso"];
    

    $sql->query("UPDATE disciplinas SET nome='$novo_nome', carga_horaria='$novo_horas', curso_id='$novo_curso' WHERE id = $id");
    header("Location: disciplinas.php");
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
                <h5 class="card-header bg-dark text-light">Disciplinas</h5>
                <div class="card-body">
                    <form action="atualizardisciplinas.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Nome</p>
                        <input type="text" name="nome" value="<?php echo $nome?>" style="width:100%">
                        <hr>
                        <p class="card-text">Carga Horária</p>
                        <input type="number" name="horas" value="<?php echo $horas?>" style="width:100%">
                        <hr>
                        <p class="card-text">Curso</p>
                        <input type="text" name="curso" value="<?php echo $curso?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="disciplinas.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
