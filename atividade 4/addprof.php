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
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>
        <div class="container">
            <table class="table">
                <tr>
                    <td><h1>Professores</h1></td>
                    <td><a href="add.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
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
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
        </div>
    </body>
</html>
