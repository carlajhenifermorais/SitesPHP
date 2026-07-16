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
    $aluno = $_GET["aluno"];
    $turma = $_GET["turma"];
    $dataMat = $_GET["datamat"];
    $status = $_GET["status"];
}else{
    $id = $_POST["id"];
    $novo_aluno = $_POST["aluno"];
    $novo_turma = $_POST["turma"];
    $novo_dataMat = $_POST["datamat"];
    $novo_status = $_POST["status"];
    

    $sql->query("UPDATE matriculas SET aluno_id ='$novo_aluno', turma_id ='$novo_turma', data_matricula='$novo_dataMat', status='$novo_status' WHERE id = $id");
    header("Location: matriculas.php");
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
                <h5 class="card-header bg-dark text-light">Matriculas</h5>
                <div class="card-body">
                    <form action="atualizarmatriculas.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Aluno</p>
                        <input type="number" name="aluno" value="<?php echo $aluno?>" style="width:100%">
                        <hr>
                        <p class="card-text">Turma</p>
                        <input type="number" name="turma" value="<?php echo $turma?>" style="width:100%">
                        <hr>
                        <p class="card-text">Data da Matrícula</p>
                        <input type="date" name="datamat" value="<?php echo $dataMat?>" style="width:100%">
                        <hr>
                        <p class="card-text">Status
                        </p>
                        <select name="status" id="status style="width:100%">
                            <option value="Ativo">Ativo</option>
                            <option value="Trancado">Trancado</option>
                            <option value="Concluido">Concluído</option>
                        </select>
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="matriculas.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
