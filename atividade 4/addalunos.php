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
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
        </div>
    </body>
</html>
