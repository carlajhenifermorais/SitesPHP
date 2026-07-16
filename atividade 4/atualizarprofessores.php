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
    $cpf = $_GET["cpf"];
    $derp = $_GET["derp"];
}else{
    $id = $_POST["id"];
    $novo_nome = $_POST["nome"];
    $novo_cpf = $_POST["cpf"];
    $novo_derp = $_POST["derp"];
    

    $sql->query("UPDATE professores SET nome='$novo_nome', cpf='$novo_cpf', departamento_id='$novo_derp' WHERE id = $id");
    header("Location: professores.php");
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
                <h5 class="card-header bg-dark text-light">Professores</h5>
                <div class="card-body">
                    <form action="atualizarprofessores.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Nome</p>
                        <input type="text" name="nome" value="<?php echo $nome?>" style="width:100%">
                        <hr>
                        <p class="card-text">CPF</p>
                        <input type="number" name="cpf" value="<?php echo $cpf?>" style="width:100%">
                        <hr>
                        <p class="card-text">Departamento</p>
                        <input type="text" name="derp" value="<?php echo $derp?>" style="width:100%">
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="professores.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
