<?php
$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "loja_web3",
    3306
);

$rs = $mysql -> query("SELECT * FROM produto");

?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-pink">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="tabelacategoria.php">Tabela categoria</a>
            <a class="nav-item nav-link" href="tabelavenda.php">Tabela venda</a>
            <a class="nav-item nav-link" href="tabelaproduto.php">Tabela produto</a>
            <a class="nav-item nav-link" href="tabelacliente.php">Tabela cliente</a>
            <a class="nav-item nav-link" href="relatorio.php">Relatório</a>
            </div>
        </div>
        </nav>
        <h1>Lista de produto</h1>
        <table border=1>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>ID Categoria</th>
                <th>Ativo</th>
            </tr>

            <?php foreach($rs as $ln): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["nome"]?></td>
                    <td><?=$ln["descricao"]?></td>
                    <td><?=$ln["preco"]?></td>
                    <td><?=$ln["estoque"]?></td>
                    <td><?=$ln["categoria_id"]?></td>
                    <td><?=$ln["ativo"]?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
