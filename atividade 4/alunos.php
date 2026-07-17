<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT a.id as ID, a.nome as Nome, a.ra as RA, a.data_nascimento as DataNasc, a.curso_id as Curso FROM alunos a JOIN cursos c ON a.curso_id = c.id");
    
if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM matriculas WHERE aluno_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem matriculas desse aluno.";
    } else {
        $sql->query("DELETE FROM alunos WHERE id = $pos");
        header("Location: alunos.php");
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
                    <tr><h1>Alunos</h1></tr>
                    <tr><a href="addalunos.php" class="btn">Adicionar novo aluno</a></tr>
                </tr>
            </table>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>RA</th>
                    <th>Data de Nascimento</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["RA"];?></td>
                        <td><?php echo $ln["DataNasc"];?></td>
                        <td><?php echo $ln["Curso"];?></td>
                        <td>
                            <a href="detalharalunos.php?id=<?php echo $ln['ID'];?>" class="btn">Detalhar</a>
                            <a href="atualizaralunos.php?pos=<?php echo $ln["ID"];?>&&nome=<?php echo $ln["Nome"];?>&&ra=<?php echo $ln["RA"];?>&&datanasc=<?php echo $ln["DataNasc"];?>&&curso=<?php echo $ln["Curso"];?>" class="btn">Editar</a>
                            <a href="alunos.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="index.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
