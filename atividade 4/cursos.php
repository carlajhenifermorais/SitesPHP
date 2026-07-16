<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT c.id as ID, c.nome as Curso, c.duracao_semestres as Duracao FROM cursos c");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM alunos a, disciplinas d WHERE a.curso_id = $pos OR d.curso_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem alunos ou disciplinas nesse curso.";
    } else {
        $sql->query("DELETE FROM cursos WHERE id = $pos");
        header("Location: cursos.php");
        exit();
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if (isset($erro)) :?>
            <p class="bg-danger text-light">
                <?php echo $erro;?>
            </p>
        <?php endif;?>
        <nav class="navbar navbar">
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <table class="table">
                <tr>
                    <td><h1>Cursos</h1></td>
                    <td><a href="deletar.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Duração</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Curso"];?></td>
                        <td><?php echo $ln["Duracao"];?> Semestres</td>
                        <td><a href="cursos.php?pos=<?php echo $ln["ID"];?>" class="btn btn-danger">Deletar</a>
                            <a href="atualizarcursos.php?pos=<?php echo $ln["ID"];?>&&curso=<?php echo $ln["Curso"];?>&&dura=<?php echo $ln["Duracao"];?>" class="btn btn-light">Editar</a>
                        </td>
                        
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
