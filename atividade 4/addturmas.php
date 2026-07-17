<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT t.id as ID, t.ano_letivo as Ano, t.semestre as Semestre, d.nome as Disciplina, p.nome as Professor FROM turmas t JOIN disciplinas d ON t.disciplina_id = d.id JOIN professores p ON t.professor_id = p.id");
$disciplinas = $sql->query("SELECT id, nome FROM disciplinas");
$professores = $sql->query("SELECT id, nome FROM professores");

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
            <h1>Turmas</h1>
            
            <table class="table">
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
                        <td><select name="disciplina">
                            <?php foreach ($disciplinas as $d): ?>
                                <option value="<?php echo $d['id']; ?>">
                                    <?php echo $d['nome']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select></td>
                        <td><select name="professor">
                            <?php foreach ($professores as $p): ?>
                                <option value="<?php echo $p['id']; ?>">
                                    <?php echo $p['nome']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn">Adicionar</button>
                </form>
                <a href="turmas.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
