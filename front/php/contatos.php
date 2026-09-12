<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./front/css/style.css">
    <title>Contatos</title>
</head>
<body>
<div align="center"> 
    <a name="topo">
        <h1>Bahia Vidros</h1>
    </a>
    <p><i>Trabalhamos com transparência!</i></p>
        <p>
        <a href="./index.php">[Início]</a>
        <a href="./front/php/sobre.php">[Quem somos]</a>
        <a href="./front/php/servicos.php">[Serviços]</a>
    </p>
    <hr>
    <h2> Contatos </h2>
</div>


<div align="justify">
<h3>Compre conosco</h3>
    <ul>
        <li>Telefone:
            <ul>
                <li>Fixo: +55 (75) 3001-1234</li>
                <li>Whatsapp: +55 (75) 9 9876-5432</li>
            </ul>
        </li>
        <li>E-mail: bahiavidrosoficial@gmail.com</li>
        <li>Endereço: Rua dos Bobos, nº 0, Centro - Feira de Santana, Bahia. </li>
    </ul>
<h3> Redes Sociais</h3>
    <ul>
        <li>Instagram: @bahia.vidroos</li>
        <li>Facebook: @bahia.vidroos </li> 
        <li>Tiktok: @vidrosbahia </li>
    </ul>
<h3> Horário de funcionamento</h3>
    <ul>
        <li>Segunda a sexta-feira: 08:00 às 18:00</li>
        <li>Sábado: 08:00 às 12:00</li>
        <li>Domingo: Fechado</li>
    </ul>
<h3> Formulário de contato <h3>
    <form action="../../back/email/enviar-email.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>

        <label for="email">E-mail:</label><br>
        <input type="text" id="email" name="email" required><br>
    
        <label for="assunto">Assunto:</label><br>
        <select>
            <option value="duvida">Dúvida</option>
            <option value="sugestao">Sugestão</option>
            <option value="reclamacao">Reclamação</option>
        </select><br>
        <input type="submit" value="Enviar">
    </form>
</div>


<div>
    <footer>
        <a href="#topo">Topo</a>
        <hr> <h5 align="center">Todos os direitos reservados</h5>
    </footer>
</div>

</body>
</html>