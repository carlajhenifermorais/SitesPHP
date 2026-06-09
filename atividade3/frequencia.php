<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "bdescola",
    3306
);

$rs = $sql->query("SELECT f.id as ID, f.matricula_id as Matricula, f.data_aula as DataAula, f.presenca as Presenca FROM frequencia f JOIN matriculas m ON f.matricula_id = m.id");

if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];

    $sql->query("DELETE FROM frequencia WHERE id = $pos");
    header("Location: frequencia.php");
    exit();
}

?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.rtl.min.css">
    </head>
    <body>
        <?php if (isset($erro)) :?>
            <p class="bg-danger text-light">
                <?php echo $erro;?>
            </p>
        <?php endif;?>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                Escola Mundial
            </a>
        </nav>

        <div class="container">
            <table class="table">
                <tr>
                    <td><h1>Frequência</h1></td>
                    <td><a href="deletar.php" class="btn btn-dark">Voltar</a></td>
                </tr>
            </table>
            
            <table class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Data da Aula</th>
                    <th>Presença</th>
                    <th>Ações</th>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Matricula"];?></td>
                        <td><?php echo $ln["DataAula"];?></td>
                        <td><?php if($ln["Presenca"]==false){echo "Faltou";}else{echo "Presente";}?></td>
                        <td>
                            <a href="frequencia.php?pos=<?php echo $ln["ID"];?>" class="btn btn-danger">Deletar</a>
                            <a href="atualizarfrequencia.php?pos=<?php echo $ln["ID"];?>&&matri=<?php echo $ln["Matricula"];?>&&dataaula=<?php echo $ln["DataAula"];?>&&pres=<?php echo $ln["Presenca"];?>" class="btn btn-light">Editar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
