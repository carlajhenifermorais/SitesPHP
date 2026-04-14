<?php

$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "mystore",
    3306
);
 
$id = $_GET["id"];

$rs = $mysql->query("SELECT * FROM categoria WHERE id = $id AND ativo=1");

if($rs->num_rows == 0) {
    $err = "Registro não existe";
}else{
    
    try {
        $mysql->query("DELETE FROM categoria WHERE id=$id");
    } catch(Exception $e) {
        $mysql->query("UPDATE categoria SET ativo=0 WHERE id=$id");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Exclusão de categoria</h1>

    <?php if(isset($err)) : ?>
        <p><?=$err?></p>
    <?php else: ?>
        <p>Exclusão realizada com sucesso</p>
    <?php endif ?>

    <p><a href="cat.php">Voltar</a></p>
</body>
</html>
