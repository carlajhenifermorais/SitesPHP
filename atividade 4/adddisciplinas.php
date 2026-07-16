<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT d.id as ID, d.nome as Nome, d.carga_horaria as Horas, c.nome as Curso FROM disciplinas d JOIN cursos c ON d.curso_id = c.id");
$cursos = $sql->query("SELECT id, nome FROM cursos");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $horas = $_POST["horas"];
    $curso = $_POST["curso"];
    $sql->query("INSERT INTO disciplinas (nome, carga_horaria, curso_id) VALUES ('$nome', '$horas', '$curso')");
    
    header("Location: adddisciplinas.php");
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
            <h1>Disciplinas</h1>
            
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <td>Carga Horária</td>
                    <td>Curso</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["Horas"];?></td>
                        <td><?php echo $ln["Curso"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="adddisciplinas.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="text" name="nome" style="width:100%"></td>
                        <td><input type="number" name="horas" style="width:100%"></td>
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
                <table class="table">
                <tr>
                    <td><a href="add.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
        </div>
    </body>
</html>
