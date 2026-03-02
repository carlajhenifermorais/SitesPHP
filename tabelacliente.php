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
        <h1>Lista de cliente</h1>
        <table>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>

            <?php foreach($rs as $ln): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["nome"]?></td>
                    <td><?=$ln["email"]?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>

</html>
