<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT p.id as ID, p.nome as Nome, p.cpf as CPF, p.departamento_id as Departamento FROM professores p JOIN departamentos d ON p.departamento_id = d.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $teste = $sql->query("SELECT * FROM turmas WHERE professor_id = $pos");

    if ($teste->num_rows > 0) {
        $erro = "Não é possível deletar. Existem turmas com esse professor.";
    } else {
        $sql->query("DELETE FROM professores WHERE id = $pos");
        header("Location: professores.php");
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
                    <tr><h1>Professores</h1></tr>
                    <tr><a href="addprof.php" class="btn">Adicionar novo professor</a></tr>
                </tr>
            </table>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Departamento</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Nome"];?></td>
                        <td><?php echo $ln["CPF"];?></td>
                        <td><?php echo $ln["Departamento"];?></td>
                        <td>
                            <a href="detalharprofessores.php?id=<?php echo $ln['ID']; ?>" class="btn">Detalhar</a>
                            <a href="atualizarprofessores.php?pos=<?php echo $ln["ID"];?>&&nome=<?php echo $ln["Nome"];?>&&cpf=<?php echo $ln["CPF"];?>&&derp=<?php echo $ln["Departamento"];?>" class="btn btn-light">Editar</a>
                            <a href="professores.php?pos=<?php echo $ln["ID"];?>" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <a href="index.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
