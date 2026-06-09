<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "bdescola",
    3306
);

$rs = $sql->query("SELECT m.id as ID, m.aluno_id as Aluno, a.turma_id as Turma, m.data_matricula as DataMat, m.status as Status FROM matriculas m JOIN matriculas a ON m.aluno_id = a.id JOIN turmas t ON m.turma_id = t.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM notas n, frequencia f WHERE n.matricula_id = $pos and f.matricula_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem notas ou frequencias dessa matricula.";
    } else {
        $sql->query("DELETE FROM matriculas WHERE id = $pos");
        header("Location: matricula.php");
        exit();
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
    </head>
    <body>
        <?php if (isset($erro)) :?>
            <p class="bg-danger text-light">
                <?php echo $erro;?>
            </p>
        <?php endif;?>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <table class="table">
                <tr>
                    <td><h1>Matrículas</h1></td>
                    <td><a href="deletar.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Turma</th>
                    <td>Data de Matrícula</td>
                    <td>Status</td>
                    <td>Ações</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Aluno"];?></td>
                        <td><?php echo $ln["Turma"];?></td>
                        <td><?php echo $ln["DataMat"];?></td>
                        <td><?php echo $ln["Status"];?></td>
                        <td>
                            <a href="matriculas.php?pos=<?php echo $ln["ID"];?>" class="btn btn-danger">Deletar</a>
                            <a href="atualizarmatriculas.php?pos=<?php echo $ln["ID"];?>&&aluno=<?php echo $ln["Aluno"];?>&&turma=<?php echo $ln["Turma"];?>&&datamat=<?php echo $ln["DataMat"];?>&&status=<?php echo $ln["Status"];?>" class="btn btn-light">Editar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
