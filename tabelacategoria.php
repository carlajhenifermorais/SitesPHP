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
        <h1>Lista de categoria</h1>
        <table>
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