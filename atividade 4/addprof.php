<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT p.id as ID, p.nome as Nome, p.cpf as CPF, d.nome as Departamento FROM professores p JOIN departamentoS d ON p.departamento_id = d.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $departamento = $_POST["departamento"];
    $sql->query("INSERT INTO professores (nome, cpf, departamento_id) VALUES ('$nome', '$cpf', '$departamento')");
    
    header("Location: addprof.php");
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
            <h1>Professores</h1>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <td>CPF</td>
                    <td>Departamento</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["CPF"];?></td>
                        <td><?php echo $ln["Departamento"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="addprof.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="text" name="nome" style="width:100%"></td>
                        <td><input type="text" name="cpf" style="width:100%"></td>
                        <td><input type="number" name="departamento" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn">Adicionar</button>
                </form>
                <a href="professores.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
