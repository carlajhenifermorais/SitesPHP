<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT d.id as ID, d.nome as Departamentos FROM departamentos d");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $sql->query("INSERT INTO departamentos (nome) VALUES ('$nome')");

    header("Location: adddepartamento.php");
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
            <h1>Departamentos</h1>
            
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Departamentos</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Departamentos"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="adddepartamento.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="text" name="nome" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
            <table class="table">
                <tr>
                    <td><a href="departamentos.php" class="btn">Voltar</a></td>
                </tr>
            </table>
        </div>
    </body>
</html>
