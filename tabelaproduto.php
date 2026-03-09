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
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <a href="index.php">Home</a>
                </td>
                <td>
                    <a href="artigos.html">Tabela usuário</a>
                </td>
                <td>
                    <a href="categorias.html">Tabela categoria</a>
                </td>
                <td>
                    <a href="sobre.html">Tabela venda</a>
                </td>
                <td>
                    <a href="sobre.html">Tabela produto</a>
                </td>
                <td>
                    <a href="sobre.html">Tabela cliente</a>
                </td>
            </tr>
        </table>
        <h1>Lista de produto</h1>
        <table>
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
