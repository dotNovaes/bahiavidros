<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
</head>
<body>

    <h2>Cadastrar Novo Produto</h2>

    <form action="/src/back/adicionar-produtos.php" method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required>
            <label for="valor">Valor (R$):</label><br>
            <input type="text" id="valor" name="valor" required>
            <label for="formato">Formato:</label><br>
            <input type="text" id="formato" name="formato" required>
            <label for="espessura">Espessura (mm):</label><br>
            <input type="text" id="espessura" name="espessura" required>
            <label for="largura">Largura (cm):</label><br>
            <input type="text" id="largura" name="largura" required>
            <label for="altura">Altura (cm):</label><br>
            <input type="text" id="altura" name="altura" required>
            <label for="idcategoria">ID da Categoria:</label><br>
            <input type="text" id="idcategoria" name="idcategoria" required>
        </p>

        <button type="submit">Salvar Produto</button>
    </form>

</body>
</html>