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
"SELECT t.id As ID, t.ano_letivo As Ano, t.semestre AS Semestre, t.professor_id As IDprof
FROM turmas t 
WHERE disciplina_id = $id"
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
            <h1>Turmas com a disciplina</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Ano letivo</th>
                    <th>Semestre</th>
                    <th>ID do professor</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Ano"];?></td>
                        <td><?php echo $ln["Semestre"];?></td>
                        <td><?php echo $ln["IDprof"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="disciplinas.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
