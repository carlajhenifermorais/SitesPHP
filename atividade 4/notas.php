<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT n.id as ID, m.id as Matricula, a.id as Avaliacao, n.valor_nota as Valor FROM notas n JOIN matriculas m ON n.matricula_id = m.id JOIN avaliacoes a ON n.avaliacao_id = a.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $sql->query("DELETE FROM notas WHERE id = $pos");
    header("Location: notas.php");
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
        <table class="table">
                <tr>
                    <tr><h1>Professores</h1></tr>
                    <tr><a href="addnotas.php" class="btn">Adicionar nova nota</a></tr>
                </tr>
            </table>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Avaliação</th>
                    <th>Nota</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Matricula"];?></td>
                        <td><?php echo $ln["Avaliacao"];?></td>
                        <td><?php echo $ln["Valor"];?></td>
                        <td>
                            <a href="atualizarnotas.php?pos=<?php echo $ln["ID"];?>&&matri=<?php echo $ln["Matricula"];?>&&ava=<?php echo $ln["Avaliacao"];?>&&valor=<?php echo $ln["Valor"];?>" class="btn">Editar</a>
                            <a href="notas.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="index.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
