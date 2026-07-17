<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);

$rs = $sql->query("SELECT f.id as ID, f.matricula_id as Matricula, f.data_aula as DataAula, f.presenca as Presenca FROM frequencia f JOIN matriculas m ON f.matricula_id = m.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST["matricula"];
    $dataAula = $_POST["dataAula"];
    $presenca = $_POST["presenca"];

    $sql->query("INSERT INTO frequencia (matricula_id, data_aula, presenca) VALUES ('$matricula', '$dataAula', '$presenca')");
    
    header("Location: addfrequencia.php");
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
            <h1>Frequência</h1>
            
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Data da Aula</th>
                    <td>Presença</td>
                </tr>
                <?php foreach($rs as $ln): ?>
                    <tr>
                        <td><?php echo $ln["ID"];?></td>
                        <td><?php echo $ln["Matricula"];?></td>
                        <td><?php echo $ln["DataAula"];?></td>
                        <td>
                            <?php if ($ln["Presenca"] == 1) {
                            echo "Presente";
                            }else {
                                echo "Faltou";
                            }?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <form action="addfrequencia.php" method="POST">
                    <tr>
                        <td><?php echo $ln["ID"]+1 ?></td>
                        <td><input type="number" name="matricula" style="width:100%"></td>
                        <td><input type="date" name="dataAula" style="width:100%"></td>
                        <td><input type="number" name="presenca" style="width:100%"></td>
                    </tr>
                    </table>
                    <button type="submit" class="btn">Adicionar</button>
                </form>
                <a href="frequencia.php" class="btn">Voltar</a>
        </div>
    </body>
</html>
