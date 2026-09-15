<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
</head>
<body>

<table border=1>
    <tr>
        <th>
        <h3>Adicionar</h3>
        <form action="/src/back/adicionar-produtos.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="valor">Valor (R$):</label>
            <input type="text" id="valor" name="valor" required><br>
            <label for="formato">Formato:</label>
            <input type="text" id="formato" name="formato" required><br>
            <label for="espessura">Espessura (mm):</label>
            <input type="text" id="espessura" name="espessura" required><br>
            <label for="largura">Largura (cm):</label>
            <input type="text" id="largura" name="largura" required><br>
            <label for="altura">Altura (cm):</label>
            <input type="text" id="altura" name="altura" required><br>
            <label for="idcategoria">ID da Categoria:</label>
            <input type="text" id="idcategoria" name="idcategoria" required><br>
            <button type="submit">adiciona</button>
        </form>
        </th>

        <th>

    <form action="src/back/ler-produtos.php" method="POST">
        <label for="idBuscar">ID de Busca</label>
        <input id="idBuscar" nome="idBuscar">
        <button type="submit" name="carregarUnidade">buscar</button>
    </form>
    <?php if ($buscouUnidade): ?>
        <?php if (!empty($produtoUnidade)): ?>
        <form>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value=<?= htmlspecialchars($produtoUnidade['nome']) ?>><br>
            <label for="valor">Valor (R$):</label>
            <input type="text" id="valor" name="valor" value=<?= number_format($produtoUnidade['valor']) ?>><br>
            <label for="formato">Formato:</label>
            <input type="text" id="formato" name="formato" value=<?= htmlspecialchars($produtoUnidade['formato']) ?>><br>
            <label for="espessura">Espessura (mm):</label>
            <input type="text" id="espessura" name="espessura" value=<?= htmlspecialchars($produtoUnidade['espessura']) ?>><br>
            <label for="largura">Largura (cm):</label>
            <input type="text" id="largura" name="largura" value=<?= htmlspecialchars($produtoUnidade['largura']) ?>><br>
            <label for="altura">Altura (cm):</label>
            <input type="text" id="altura" name="altura" value=<?= htmlspecialchars($produtoUnidade['altura']) ?>><br>
            <label for="idcategoria">ID da Categoria:</label>
            <input type="text" id="idcategoria" name="idcategoria" <?= $produtoUnidade['idcategoria'] ?>><br>
            <button type="submit">edita</button>
        </form>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
    <?php endif; ?>



        </th>
    </tr>
</table>



    <h2>Gerenciar Produtos</h2>
    <form action="src/back/ler-produtos.php" method="GET">
        <button type="submit" name="carregar">Carregar</button>
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
                    <!-- botao apagar -->
                            <td>
                                <form action="/src/back/remover-produtos.php" method="POST">
                                    <input type="text" name="idDelete" hidden value=<?= $produto['idprodutos'] ?>>
                                    <button type="submit">apagar</button>
                                </form>
                            </td>
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