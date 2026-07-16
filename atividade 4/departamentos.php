<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);
$idx = 1;
$rs = $sql->query("SELECT d.id as ID, d.nome as Departamentos FROM departamentos d");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM professores WHERE departamento_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem professores nesse departamento.";
    } else {
        $sql->query("DELETE FROM departamentos WHERE id = $pos");
        header("Location: departamentos.php");
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
                    <td><h1>Departamentos</h1></td>
                    <td><a href="index.php" class="btn">Voltar</a></td>
                </tr>
            </table>
            
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Departamentos</th>
                    <th>Ação</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Departamentos"];?></td>
                        <td>
                            <a href="detalhardepartamento.php?pos=<?php echo $ln["ID"];?>" class="btn">Detalhar</a>
                            <a href="adddepartamento.php?pos=<?php echo $ln["ID"];?>" class="btn">Adicionar</a>
                            <a href="atualizardep.php?pos=<?php echo $ln["ID"];?>&&derp=<?php echo $ln["Departamentos"];?>" class="btn">Editar</a>
                            <a href="departamentos.php?pos=<?php echo $ln["ID"];?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                    <?php $idx++ ?>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
