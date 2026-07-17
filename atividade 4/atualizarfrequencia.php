<?php

$sql = new mysqli(
    "Localhost",
    "root",
    "",
    "gestao_escolar",
    3306
);
$idx = 1;



if (sizeof($_GET) > 0){
    $pos = $_GET["pos"];
    $matricula = $_GET["matri"];
    $dataAula = $_GET["dataaula"];
    $presenca = $_GET["pres"];
}else{
    $id = $_POST["id"];
    $novo_matricula = $_POST["matri"];
    $novo_dataAula = $_POST["dataaula"];
    $novo_presenca = $_POST["pres"];
    

    $sql->query("UPDATE frequencia SET matricula_id='$novo_matricula', data_aula='$novo_dataAula', presenca ='$novo_presenca' WHERE id = $id");
    header("Location: frequencia.php");
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
            <br>
            <div class="card">
                <h5 class="card-header">Frequência</h5>
                <div class="card-body">
                    <form action="atualizarfrequencia.php" method="POST"> 
                        <input type="hidden" value="<?php echo $pos?>" name="id">
                        <p class="card-text">Matrícula</p>
                        <input type="text" name="matri" value="<?php echo $matricula?>" style="width:100%">
                        <hr>
                        <p class="card-text">Data da Aula</p>
                        <input type="date" name="dataaula" value="<?php echo $dataAula?>" style="width:100%">
                        <hr>
                        <p class="card-text">Presença</p>
                        <select name="pres" style="width:100%">
                           <option value="1" <?php if($presenca == 1) echo "selected"; ?>>
                                Presente
                            </option>
                            <option value="0" <?php if($presenca == 0) echo "selected"; ?>>
                                Ausente
                            </option>
                        </select>
                        <hr>
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <td><a href="frequencia.php" class="btn btn-danger">Cancelar</a></td>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
