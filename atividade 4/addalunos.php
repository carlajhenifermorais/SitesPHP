<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT a.id as ID, a.nome as Nome, a.ra as RA, a.data_nascimento as DataNasc, c.nome as Curso FROM alunos a JOIN cursos c ON a.curso_id = c.id");
$cursos = $sql->query("SELECT id, nome FROM cursos");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $ra = $_POST["ra"];
    $dataNasc = $_POST["dataNasc"];
    $curso = $_POST["curso"];
    
    $sql->query("INSERT INTO alunos (nome, ra, data_nascimento, curso_id) VALUES ('$nome', '$ra', '$dataNasc', '$curso')");

    header("Location: addalunos.php");
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
            <h1>Alunos</h1>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>RA</th>
                    <td>Data de Nascimento</td>
                    <td>Curso</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["RA"];?></td>
                        <td><?php echo $ln["DataNasc"];?></td>
                        <td><?php echo $ln["Curso"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="addalunos.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="text" name="nome" style="width:100%"></td>
                        <td><input type="number" name="ra" style="width:100%"></td>
                        <td><input type="date" name="dataNasc" style="width:100%"></td>
                        <td>
                            <select name="curso" style="width:100%">
                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?php echo $curso['id']; ?>">
                                        <?php echo $curso['nome']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    </table>
                    <button type="submit" class="btn">Adicionar</button>
                </form>
                <a href="alunos.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
