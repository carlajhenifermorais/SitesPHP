?php
$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "loja_web3",
    3306
);

$rs = $mysql -> query("SELECT * FROM cliente");

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
                <th>Cpf</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>CEP</th>
                <th>Data Cadastro</th>
            </tr>

            <?php foreach($rs as $ln): ?>
                <tr>
                    <td><?=$ln["id"]?></td>
                    <td><?=$ln["nome"]?></td>
                    <td><?=$ln["cpf"]?></td>
                    <td><?=$ln["email"]?></td>
                    <td><?=$ln["telefone"]?></td>
                    <td><?=$ln["endereco"]?></td>
                    <td><?=$ln["cep"]?></td>
                    <td><?=$ln["data_cadastro"]?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>

</html>
