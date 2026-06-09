<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "bdescola",
    3306
);

$rs = $sql->query("SELECT n.id as ID, m.id as Matricula, a.id as Avaliacao, n.valor_nota as Valor FROM notas n JOIN matriculas m ON n.matricula_id = m.id JOIN avaliacoes a ON n.avaliacao_id = a.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST["matricula"];
    $avaliacao = $_POST["avaliacao"];
    $valor = $_POST["valor"];

    $sql->query("INSERT INTO notas (matricula_id, avaliacao_id, valor_nota) VALUES ('$matricula', '$avaliacao', '$valor')");

    header("Location: addnotas.php");
    exit();
}

?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <table class="table">
                <tr>
                    <td><h1>Alunos</h1></td>
                    <td><a href="add.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Avaliação</th>
                    <td>Nota</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Matricula"];?></td>
                        <td><?php echo $ln["Avaliacao"];?></td>
                        <td><?php echo $ln["Valor"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="addnotas.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="number" name="matricula" style="width:100%"></td>
                        <td><input type="number" name="avaliacao" style="width:100%"></td>
                        <td><input type="number" name="valor" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
        </div>
    </body>
</html>
