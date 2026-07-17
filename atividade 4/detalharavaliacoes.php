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
"SELECT n.id As ID, n.matricula_id As IDmatricula, n.avaliacao_id AS IDavaliacao, n.valor_nota As Valor
FROM notas n
WHERE avaliacao_id = $id"
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
            <h1>Notas da avaliação</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>ID da matrícula</th>
                    <th>ID da avaliação</th>
                    <th>Valor da nota</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["IDmatricula"];?></td>
                        <td><?php echo $ln["IDavaliacao"];?></td>
                        <td><?php echo $ln["Valor"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="avaliacoes.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
