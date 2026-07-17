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
"SELECT p.id As ID, p.nome As Nome, p.cpf AS CPF
FROM professores p
WHERE departamento_id = $id"
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
            <h1>Professores do departamento</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["CPF"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="departamentos.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
