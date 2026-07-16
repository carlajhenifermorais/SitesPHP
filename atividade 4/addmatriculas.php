<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT m.id as ID, a.nome as Aluno, t.id as Turma, m.data_matricula as DataMat, m.status as Status FROM matriculas m JOIN alunos a ON m.aluno_id = a.id JOIN turmas t ON m.turma_id = t.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno = $_POST["aluno"];
    $turma = $_POST["turma"];
    $dataMat = $_POST["dataMat"];
    $status = $_POST["status"];

    $sql->query("INSERT INTO matriculas (aluno_id, turma_id, data_matricula, status) VALUES ('$aluno', '$turma', '$dataMat', '$status')");
    
    header("Location: addmatriculas.php");
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
            <table class="table">
                <tr>
                    <td><h1>Matrículas</h1></td>
                    <td><a href="add.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Turma</th>
                    <td>Data de Matrícula</td>
                    <td>Status</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Aluno"];?></td>
                        <td><?php echo $ln["Turma"];?></td>
                        <td><?php echo $ln["DataMat"];?></td>
                        <td><?php echo $ln["Status"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="addmatriculas.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="text" name="aluno" style="width:100%"></td>
                        <td><input type="number" name="turma" style="width:100%"></td>
                        <td><input type="date" name="dataMat" style="width:100%"></td>
                        <td><input type="text" name="status" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
        </div>
    </body>
</html>
