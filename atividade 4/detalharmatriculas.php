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
"SELECT n.id As ID, n.avaliacao_id As IDavaliacao, n.valor_nota AS Valor
FROM notas n
WHERE matricula_id = $id"
);

$abelha = $sql->query(
"SELECT f.id As ID, f.data_aula As Data, f.presenca As Presenca
FROM frequencia f
WHERE matricula_id = $id"
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
            <h1>Notas atribuídas à matrícula</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>ID da avaliação</th>
                    <th>Valor da nota</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["IDavaliacao"];?></td>
                        <td><?php echo $ln["Valor"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>

            <h1>Frequência da matrícula</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Data da aula</th>
                    <th>Presença</th>
                </tr>
                <?php foreach($abelha as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Data"];?></td>
                        <td><?php echo $ln["Presenca"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="matriculas.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
