<?php
$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "loja_web3",
    3306
);

$rs = $mysql -> query("SELECT * FROM venda");

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
        <h1>Relatório</h1>
        <table border=1>
            <tr>
                <th>Código</th>
                <th>Código do cliente</th>
                <th>Usuário</th>
                <th>Data venda</th>
            </tr>
         
        <?php foreach($rs as $ln): ?>
            <?php if(date("m", strtotime($ln["data_venda"])) == date("m") && date("Y", strtotime($ln["data_venda"])) == date("Y")): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["cliente_id"]?></td>
                    <td><?=$ln["usuario_id"]?></td>
                    <td><?=$ln["data_venda"]?></td>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
        </table>
    </body>
</html>
