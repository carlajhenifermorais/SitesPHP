<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "bdescola",
    3306
);

$rs = $sql->query("SELECT t.id as ID, t.ano_letivo as Ano, t.semestre as Semestre, d.nome as Disciplina, p.nome as Professor FROM turmas t JOIN disciplinas d ON t.disciplina_id = d.id JOIN professores p ON t.professor_id = p.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ano = $_POST["ano"];
    $semestre = $_POST["semestre"];
    $disciplina = $_POST["disciplina"];
    $professor = $_POST["professor"];

    $sql->query("INSERT INTO turmas (ano_letivo, semestre, disciplina_id, professor_id) VALUES ('$ano', '$semestre', '$disciplina', '$professor')");
    
    header("Location: addturmas.php");
    exit();
}


?>

<html>
    <<head>
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
                    <td><h1>Turmas</h1></td>
                    <td><a href="add.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Ano Letivo</th>
                    <th>Semestre</th>
                    <td>Disciplina</td>
                    <td>Professor</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Ano"];?></td>
                        <td><?php echo $ln["Semestre"];?></td>
                        <td><?php echo $ln["Disciplina"];?></td>
                        <td><?php echo $ln["Professor"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="addturmas.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="number" name="ano" style="width:100%"></td>
                        <td><input type="number" name="semestre" style="width:100%"></td>
                        <td><input type="number" name="disciplina" style="width:100%"></td>
                        <td><input type="number" name="professor" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
        </div>
    </body>
</html>
