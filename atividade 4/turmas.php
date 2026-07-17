<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT t.id as ID, t.ano_letivo as Ano, t.semestre as Semestre, t.disciplina_id as Disciplina, t.professor_id as Professor FROM turmas t JOIN disciplinas d ON t.disciplina_id = d.id JOIN professores p ON t.professor_id = p.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM matriculas m, avaliacoes a WHERE a.turma_id = $pos AND m.turma_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem matriculas ou avaliações dessa turma.";
    } else {
        $sql->query("DELETE FROM turmas WHERE id = $pos");
        header("Location: turmas.php");
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
                    <tr><h1>Turmas</h1></tr>
                    <tr><a href="addturmas.php" class="btn">Adicionar nova turma</a></tr>
                </tr>
            </table>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Ano Letivo</th>
                    <th>Semestre</th>
                    <th>Disciplina</th>
                    <th>Professor</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Ano"];?></td>
                        <td><?php echo $ln["Semestre"];?></td>
                        <td><?php echo $ln["Disciplina"];?></td>
                        <td><?php echo $ln["Professor"];?></td>
                        <td>
                            <a href="detalharturmas.php?id=<?php echo $ln['ID'];?>" class="btn">Detalhar</a>
                            <a href="atualizarturmas.php?pos=<?php echo $ln["ID"];?>&&ano=<?php echo $ln["Ano"];?>&&sem=<?php echo $ln["Semestre"];?>&&disc=<?php echo $ln["Disciplina"];?>&&prof=<?php echo $ln["Professor"];?>" class="btn">Editar</a>
                            <a href="turmas.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="index.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
