<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT c.id as ID, c.nome as Curso, c.duracao_semestres as Duracao FROM cursos c");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $curso = $_POST["curso"];
    $duracao = $_POST["duracao"];
    
    $sql->query("INSERT INTO cursos (nome, duracao_semestres) VALUES ('$curso', '$duracao')");
    
    header("Location: addcursos.php");
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
            <h1>Cursos</h1>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Duração</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Curso"];?></td>
                        <td><?php echo $ln["Duracao"];?> Semestres</td>
                    </tr>
                <?php endforeach ?>
            <form action="addcursos.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="text" name="curso" style="width:100%"></td>
                        <td><input type="number" name="duracao" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn">Adicionar</button>
                </form>
                <a href="cursos.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
