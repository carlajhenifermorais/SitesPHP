<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$id = $_GET["id"];

$rs = $sql->query(
"SELECT m.id As ID, m.turma_id As IDturma, m.data_matricula AS DataM, m.status As Status
FROM matriculas m
WHERE aluno_id = $id"
);

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
            <h1>Matrículas do aluno</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID da matrícula</th>
                    <th>ID da turma</th>
                    <th>Data da matrícula</th>
                    <th>Status</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["IDturma"];?></td>
                        <td><?php echo $ln["DataM"];?></td>
                        <td><?php echo $ln["Status"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="alunos.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
