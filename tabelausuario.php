<?php
$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "loja_web3",
    3306
);

$rs = $mysql -> query("SELECT * FROM usuario");

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
        <h1>Lista de usuario</h1>
        <table>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Ativo</th>
                <th>Tipo</th>
            </tr>

            <?php foreach($rs as $ln): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["nome"]?></td>
                    <td><?=$ln["email"]?></td>
                    <td><?=$ln["senha"]?></td>
                    <td><?=$ln["ativo"]?></td>
                    <td><?=$ln["tipo"]?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
