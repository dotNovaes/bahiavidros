document.addEventListener('DOMContentLoaded', function () {
    carregarCategoriasFiltro();
});

function carregarCategoriasFiltro() {
    const nav = document.getElementById('filtro-categorias');
    if (!nav) {
        return;
    }

    fetch('../../back/listar-categorias.php', {
        headers: { Accept: 'application/json' }
    })
        .then(function (resposta) {
            if (!resposta.ok) {
                throw new Error('Falha ao carregar categorias do filtro.');
            }
            return resposta.json();
        })
        .then(function (categorias) {
            nav.innerHTML = '';

            const botaoTodos = document.createElement('a');
            botaoTodos.href = '#';
            botaoTodos.className = 'menu-botao ativo';
            botaoTodos.dataset.filtro = 'todos';
            botaoTodos.textContent = 'Todos';
            botaoTodos.addEventListener('click', function (evento) {
                evento.preventDefault();
                aplicarFiltro('todos', nav);
            });
            nav.appendChild(botaoTodos);

            categorias.forEach(function (categoria) {
                const botao = document.createElement('a');
                const valorFiltro = normalizarCategoriaParaFiltro(categoria.nome);
                botao.href = '#';
                botao.className = 'menu-botao';
                botao.dataset.filtro = valorFiltro;
                botao.textContent = categoria.nome;
                botao.addEventListener('click', function (evento) {
                    evento.preventDefault();
                    aplicarFiltro(valorFiltro, nav);
                });
                nav.appendChild(botao);
            });
        })
        .catch(function (erro) {
            console.error(erro);
            nav.innerHTML = '<span class="menu-botao ativo" data-filtro="todos">Todos</span>';
        });
}

function aplicarFiltro(filtro, nav) {
    const botoes = nav.querySelectorAll('[data-filtro]');
    const cards = document.querySelectorAll('[data-categoria]');

    botoes.forEach(function (botao) {
        botao.classList.toggle('ativo', botao.dataset.filtro === filtro);
    });

    cards.forEach(function (card) {
        const mostrar = (filtro === 'todos' || card.dataset.categoria === filtro);
        card.style.display = mostrar ? '' : 'none';
    });
}

function normalizarCategoriaParaFiltro(valor) {
    const texto = String(valor || '')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .trim();

    const normalizado = texto
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');

    if (!normalizado) {
        return 'todos';
    }

    const singular = normalizado.endsWith('s') ? normalizado.slice(0, -1) : normalizado;
    const aliases = {
        'porta': 'porta',
        'janela': 'janela',
        'box': 'box',
        'espelho': 'espelho'
    };

    return aliases[singular] || singular;
}