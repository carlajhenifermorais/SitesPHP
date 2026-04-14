<?php

if(sizeof($_POST) > 0) {
    $mysql = new mysqli(
        "localhost",
        "root",
        "",
        "loja_web2",
        3306
    );

    $nome = $_POST["nome"];
    $desc = $_POST["desc"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];

    $mysql->query("INSERT INTO produto(nome,descricao,preco,estoque) VALUES('$nome','$desc','$preco','$estoque')");
}
?>
<html>
    <head>
</head>
<body>
    <h1>Cadastro de produto</h1>

    <form method="POST" action="produto.cad.php">
        <p>Nome: <input type="text" name="nome"></p>
        <p>Descricao: <input type="text" name="desc"></p>
        <p>Preço: <input type="number" name="preco"></p>
        <p>Estoque: <input type="number" name="estoque"></p>
        <p>
            <button type="submit">Salvar</button>
        </p>
</form>
</body>
</html>
