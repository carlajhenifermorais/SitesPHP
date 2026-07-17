<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT m.id as ID, a.nome as Aluno, t.id as Turma, m.data_matricula as DataMat, m.status as Status FROM matriculas m JOIN alunos a ON m.aluno_id = a.id JOIN turmas t ON m.turma_id = t.id");
$alunos = $sql->query("SELECT id, nome FROM alunos");
$turmas = $sql->query("SELECT id FROM turmas");
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
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar">
            <a class="navbar-brand" href="index.php">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <h1>Matrículas</h1>
            
            <table class="table">
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
                        <td>
                            <select name="aluno" style="width:100%">
                                <?php foreach ($alunos as $aluno): ?>
                                    <option value="<?php echo $aluno['id']; ?>">
                                        <?php echo $aluno['nome']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                        <select name="turma" style="width:100%">
                                <?php foreach ($turmas as $turma): ?>
                                    <option value="<?php echo $turma['id']; ?>">
                                        <?php echo $turma['id']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="date" name="dataMat" style="width:100%"></td>
                        <td>
                        <select name="status">
                            <option value="Ativo">Ativo</option>
                            <option value="Trancado">Trancado</option>
                            <option value="Concluido">Concluído</option>
                        </select>
                        </td>
                    </tr>
                    </table>
                    <button type="submit" class="btn">Adicionar</button>
                </form>
                <a href="matriculas.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
