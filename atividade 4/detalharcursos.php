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
"SELECT d.id As ID, d.nome As Nome, d.carga_horaria AS Carga
FROM disciplinas d
WHERE curso_id = $id"
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
            <h1>Disciplinas do curso</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Carga</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["Carga"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="cursos.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
