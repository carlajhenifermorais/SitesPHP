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
    $nome = $_GET["nome"];
    $ra = $_GET["ra"];
    $dataNasc = $_GET["datanasc"];
    $curso = $_GET["curso"];
}else{
    $id = $_POST["id"];
    $novo_nome = $_POST["nome"];
    $novo_ra = $_POST["ra"];
    $novo_dataNasc = $_POST["datanasc"];
    $novo_curso = $_POST["curso"];
    

    $sql->query("UPDATE alunos SET nome='$novo_nome', ra ='$novo_ra', data_nascimento='$novo_dataNasc', curso_id='$novo_curso' WHERE id = $id");
    header("Location: alunos.php");
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
            <a class="navbar-brand" href="index.php">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <div class="card">
                <h5 class="card-header bg-dark text-light">Alunos</h5>
                <div class="card-body">
                    <form action="atualizar_alunos.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Nome</p>
                        <input type="text" name="nome" value="<?php echo $nome?>" style="width:100%">
                        <hr>
                        <p class="card-text">RA</p>
                        <input type="number" name="ra" value="<?php echo $ra?>" style="width:100%">
                        <hr>
                        <p class="card-text">Data de Nascimento</p>
                        <input type="date" name="datanasc" value="<?php echo $dataNasc?>" style="width:100%">
                        <hr>
                        <p class="card-text">Curso</p>
                        <input type="number" name="curso" value="<?php echo $curso?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="alunos.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
