<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
</head>
<body>

    <h2>Gerenciar Produtos</h2>
    <form action="src/back/ler-produtos.php" method="GET">
        <button type="submit" name="carregar" value="1">Carregar Produtos</button>
    </form>

    <hr>

    <?php if (isset($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <!-- Só exibe o resultado se o botão tiver sido clicado -->
    <?php if ($buscou): ?>
        <?php if (!empty($produtos)): ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Formato</th>
                        <th>Espessura</th>
                        <th>Dimensões (L x A)</th>
                        <th>Cat. ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= $produto['idprodutos'] ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td>R$ <?= number_format($produto['valor'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($produto['formato']) ?></td>
                            <td><?= htmlspecialchars($produto['espessura']) ?></td>
                            <td><?= htmlspecialchars($produto['largura']) ?> x <?= htmlspecialchars($produto['altura']) ?></td>
                            <td><?= $produto['idcategoria'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>