<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT a.id as ID, t.id as Turma, a.descricao as Descricao, a.peso as Peso FROM avaliacoes a JOIN turmas t ON a.turma_id = t.id");
$turmas = $sql->query("SELECT id FROM turmas");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $turma = $_POST["turma"];
    $descricao = $_POST["descricao"];
    $peso = $_POST["peso"];

    $sql->query("INSERT INTO avaliacoes (turma_id, descricao, peso) VALUES ('$turma', '$descricao', '$peso')");
    
    header("Location: addavaliacoes.php");
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
                    <td><h1>Avaliações</h1></td>
                    <td><a href="add.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Turma</th>
                    <th>Descrição</th>
                    <td>Peso</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Turma"];?></td>
                        <td><?php echo $ln["Descricao"];?></td>
                        <td><?php echo $ln["Peso"];?></td>
                    </tr>
                <?php endforeach ?>
                <form action="addavaliacoes.php" method="POST">
                    <tr>
                        <td>Automático</td>
                        <td>
                            <select name="turma" style="width:100%">
                                <?php foreach ($turmas as $turma): ?>
                                    <option value="<?php echo $turma['id']; ?>">
                                        <?php echo $turma['id']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" name="descricao" style="width:100%"></td>
                        <td><input type="number" name="peso" step="0.01" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn btn-dark">Adicionar</button>
                </form>
        </div>
    </body>
</html>
