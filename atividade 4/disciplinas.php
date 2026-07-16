<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT d.id as ID, d.nome as Nome, d.carga_horaria as Horas, d.curso_id as Curso FROM disciplinas d JOIN cursos c ON d.curso_id = c.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM turmas WHERE disciplina_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem turmas dessa disciplina.";
    } else {
        $sql->query("DELETE FROM disciplinas WHERE id = $pos");
        header("Location: disciplina.php");
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
            <a class="navbar-brand" href="index.php">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <table class="table">
                <tr>
                    <tr><h1>Disciplinas</h1></tr>
                    <tr><a href="adddisciplinas.php" class="btn">Adicionar nova disciplina</a></tr>
                </tr>
            </table>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Carga Horária</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["Horas"];?></td>
                        <td><?php echo $ln["Curso"];?></td>
                        <td>
                            <a href="detalhardisciplinas.php?pos=<?php echo $ln["ID"];?>" class="btn">Detalhar</a>
                            <a href="atualizardisciplinas.php?pos=<?php echo $ln["ID"];?>&&nome=<?php echo $ln["Nome"];?>&&horas=<?php echo $ln["Horas"];?>&&curso=<?php echo $ln["Curso"];?>" class="btn">Editar</a>
                            <a href="disciplinas.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="index.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
