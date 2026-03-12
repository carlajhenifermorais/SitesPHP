<?php
$mysql = new mysqli(
    "localhost",
    "root",
    "",
    "loja_web3",
    3306
);

$data = $mysql -> query("SELECT id, nome, descricao FROM categoria; SELECT id, categoria_id, produto_id FROM categoria_produto;
                        SELECT id, nome, cpf, email, telefone, endereco, cep, data_cadastro FROM cliente");

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
        <h1>Relatório</h1>
    </body>

</html>
