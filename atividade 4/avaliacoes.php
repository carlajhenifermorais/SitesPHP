<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT a.id as ID, t.id as Turma, a.descricao as Descricao, a.peso as Peso FROM avaliacoes a JOIN turmas t ON a.turma_id = t.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM notas WHERE matricula_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem notas dessa avaliação.";
    } else {
        $sql->query("DELETE FROM avaliacoes WHERE id = $pos");
        header("Location: avaliacoes.php");
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
                    <td><h1>Avaliações</h1></td>
                    <td><a href="index.php" class="btn">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Turma</th>
                    <th>Descrição</th>
                    <th>Peso</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Turma"];?></td>
                        <td><?php echo $ln["Descricao"];?></td>
                        <td><?php echo $ln["Peso"];?></td>
                        <td>
                            <a href="detalharavaliacoes.php?pos=<?php echo $ln["ID"];?>" class="btn">Detalhar</a>
                            <a href="addavaliacoes.php?pos=<?php echo $ln["ID"];?>" class="btn">Adicionar</a>
                            <a href="atualizaravaliacoes.php?pos=<?php echo $ln["ID"];?>&&turma=<?php echo $ln["Turma"];?>&&desc=<?php echo $ln["Descricao"];?>&&peso=<?php echo $ln["Peso"];?>" class="btn">Editar</a>
                            <a href="avaliacoes.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
