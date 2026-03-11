<?php
$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "loja_web3",
    3306
);

$rs = $mysql -> query("SELECT * FROM categoria");

?>
<html>
    <head>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <a href="index.php">Home</a>
                </td>
                <td>
                    <a href="tabelausuario.php">Tabela usuário</a>
                </td>
                <td>
                    <a href="tabelacategoria.php">Tabela categoria</a>
                </td>
                <td>
                    <a href="tabelavenda.php">Tabela venda</a>
                </td>
                <td>
                    <a href="tabelaproduto.php">Tabela produto</a>
                </td>
                <td>
                    <a href="tabelacliente.php">Tabela cliente</a>
                </td>
                <td>
                    <a href="relatorio.php">Relatório</a>
                </td>
            </tr>
        </table>
        <h1>Lista de categoria</h1>
        <table border=1>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>

            <?php foreach($rs as $ln): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["nome"]?></td>
                    <td><?=$ln["descricao"]?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
