document.addEventListener('DOMContentLoaded', function () {
    carregarUsuarios();
    document.getElementById('form-novo-usuario').addEventListener('submit', criarUsuario);
});

function carregarUsuarios() {
    fetch('../../back/usuarios.php')
        .then(verificarResposta)
        .then(function (usuarios) {
            const lista = document.getElementById('lista-usuarios');
            lista.replaceChildren();

            if (!usuarios.length) {
                lista.textContent = 'Nenhum usuário cadastrado.';
                return;
            }

            const tabela = document.createElement('table');
            tabela.className = 'tabela-usuarios';
            tabela.innerHTML = '<thead><tr><th>Nome</th><th>E-mail</th><th>Tipo</th><th>Ações</th></tr></thead>';
            const corpo = document.createElement('tbody');

            usuarios.forEach(function (usuario) {
                corpo.appendChild(criarLinhaUsuario(usuario));
            });

            tabela.appendChild(corpo);
            lista.appendChild(tabela);
        })
        .catch(mostrarErro);
}

function criarLinhaUsuario(usuario) {
    const linha = document.createElement('tr');
    linha.appendChild(criarCelula(usuario.nome));
    linha.appendChild(criarCelula(usuario.email));
    linha.appendChild(criarCelula(Number(usuario.tipo) === 2 ? 'Administrador' : 'Usuário'));

    const acoes = document.createElement('td');
    const editar = criarBotao('Editar', function () { abrirEdicao(usuario); });
    const excluir = criarBotao('Excluir', function () { excluirUsuario(usuario.idusuario); });
    acoes.appendChild(editar);
    if (Number(usuario.idusuario) !== obterIdAtual()) {
        acoes.appendChild(excluir);
    }
    linha.appendChild(acoes);
    return linha;
}

function criarUsuario(evento) {
    evento.preventDefault();
    const dados = new FormData(evento.target);

    fetch('../../back/usuarios.php?acao=criar', {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: dados
    })
        .then(verificarResposta)
        .then(function () {
            evento.target.reset();
            carregarUsuarios();
        })
        .catch(mostrarErro);
}

function abrirEdicao(usuario) {
    const nome = prompt('Nome:', usuario.nome);
    if (nome === null) return;
    const email = prompt('E-mail:', usuario.email);
    if (email === null) return;
    const tipo = prompt('Tipo: 1 para usuário ou 2 para administrador:', usuario.tipo);
    if (tipo === null) return;
    const senha = prompt('Nova senha (deixe vazio para manter):', '');
    if (senha === null) return;

    const dados = new FormData();
    dados.append('idusuario', usuario.idusuario);
    dados.append('nome', nome.trim());
    dados.append('email', email.trim());
    dados.append('tipo', tipo);
    dados.append('senha', senha);

    fetch('../../back/usuarios.php?acao=editar', {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: dados
    })
        .then(verificarResposta)
        .then(carregarUsuarios)
        .catch(mostrarErro);
}

function excluirUsuario(id) {
    if (!confirm('Deseja excluir este usuário?')) return;

    const dados = new FormData();
    dados.append('idusuario', id);

    fetch('../../back/usuarios.php?acao=excluir', {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: dados
    })
        .then(verificarResposta)
        .then(carregarUsuarios)
        .catch(mostrarErro);
}

function criarBotao(texto, aoClicar) {
    const botao = document.createElement('button');
    botao.type = 'button';
    botao.className = 'botao-produto';
    botao.textContent = texto;
    botao.addEventListener('click', aoClicar);
    return botao;
}

function criarCelula(texto) {
    const celula = document.createElement('td');
    celula.textContent = texto;
    return celula;
}

function verificarResposta(resposta) {
    if (!resposta.ok) {
        return resposta.json().then(function (erro) {
            throw new Error(erro.erro || 'Não foi possível concluir a operação.');
        });
    }
    return resposta.json();
}

function mostrarErro(erro) {
    alert(erro.message || 'Não foi possível concluir a operação.');
}

function obterIdAtual() {
    return Number(document.querySelector('[data-id-atual]').dataset.idAtual);
}
