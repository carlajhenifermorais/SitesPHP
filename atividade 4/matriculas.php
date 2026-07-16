<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT
    m.id AS ID,
    m.aluno_id AS Aluno,
    m.turma_id AS Turma,
    m.data_matricula AS DataMat,
    m.status AS Status
FROM matriculas m
JOIN alunos a ON m.aluno_id = a.id
JOIN turmas t ON m.turma_id = t.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM notas n, frequencia f WHERE n.matricula_id = $pos and f.matricula_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem notas ou frequencias dessa matricula.";
    } else {
        $sql->query("DELETE FROM matriculas WHERE id = $pos");
        header("Location: matriculas.php");
        exit();
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if (isset($erro)) :?>
            <p class="bg-danger text-light">
                <?php echo $erro;?>
            </p>
        <?php endif;?>
        <nav class="navbar navbar">
            <a class="navbar-brand" href="index.php">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <table class="table">
                <tr>
                    <td><h1>Matrículas</h1></td>
                    <td><a href="index.php" class="btn">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table">
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
                            <a href="detalharmatriculas.php?pos=<?php echo $ln["ID"];?>" class="btn">Detalhar</a>
                            <a href="addmatriculas.php?pos=<?php echo $ln["ID"];?>" class="btn">Adicionar</a>
                            <a href="atualizarmatriculas.php?pos=<?php echo $ln["ID"];?>&&aluno=<?php echo $ln["Aluno"];?>&&turma=<?php echo $ln["Turma"];?>&&datamat=<?php echo $ln["DataMat"];?>&&status=<?php echo $ln["Status"];?>" class="btn">Editar</a>
                            <a href="matriculas.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
