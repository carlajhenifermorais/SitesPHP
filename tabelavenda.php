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
    </head>
    <body>
        <h1>Lista de vendas</h1>
        <table>
            <tr>
                <th>Código</th>
                <th>ID cliente</th>
                <th>ID usuário</th>
                <th>Data venda</th>
            </tr>

            <?php foreach($rs as $ln): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["cliente_id"]?></td>
                    <td><?=$ln["usuario_id"]?></td>
                    <td><?=$ln["data_venda"]?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>

</html>
