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
"SELECT m.id As ID, m.aluno_id As IDaluno, m.turma_id AS IDturma, m.data_matricula As Data, m.status As Status
FROM matriculas m
WHERE turma_id = $id"
);

$abelha = $sql->query(
"SELECT a.id As ID, a.descricao As Descricao, a.peso As Peso
FROM avaliacoes a
WHERE turma_id = $id"
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
            <h1>Matrículas da turma</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>ID do aluno</th>
                    <th>ID da turma</th>
                    <th>Data da matrícula</th>
                    <th>Status</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["IDaluno"];?></td>
                        <td><?php echo $ln["IDturma"];?></td>
                        <td><?php echo $ln["Data"];?></td>
                        <td><?php echo $ln["Status"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>

            <h1>Avaliações da turma</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Peso</th>
                </tr>
                <?php foreach($abelha as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Descricao"];?></td>
                        <td><?php echo $ln["Peso"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="turmas.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
