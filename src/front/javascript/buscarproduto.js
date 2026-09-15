document.addEventListener('DOMContentLoaded', function () {
    carregarProdutos();
    configurarBotaoCriarCategoria();
});

function configurarBotaoCriarCategoria() {
    const botao = document.getElementById('btn-criar-categoria');
    if (!botao) {
        return;
    }

    botao.addEventListener('click', function () {
        const modal = document.createElement('div');
        modal.className = 'modal-produto';
        modal.innerHTML = `
            <div class="modal-produto-conteudo" role="dialog" aria-modal="true" aria-labelledby="titulo-categoria">
                <button type="button" class="modal-produto-fechar" aria-label="Fechar">&times;</button>
                <h2 id="titulo-categoria">Gerenciar categorias</h2>
                <form class="formulario-edicao" id="form-criar-categoria">
                    <label>Nome da categoria
                        <input name="nome" type="text" required placeholder="Ex: Portas">
                    </label>
                    <div class="modal-produto-acoes">
                        <button type="button" class="botao-produto cancelar-edicao">Cancelar</button>
                        <button type="submit" class="botao-produto salvar-edicao">Salvar</button>
                    </div>
                </form>
                <div class="lista-categorias-wrapper">
                    <h3>Categorias cadastradas</h3>
                    <ul id="lista-categorias" class="lista-categorias"></ul>
                </div>
            </div>`;

        const fechar = function () { modal.remove(); };
        modal.querySelector('.modal-produto-fechar').addEventListener('click', fechar);
        modal.querySelector('.cancelar-edicao').addEventListener('click', fechar);
        modal.addEventListener('click', function (evento) {
            if (evento.target === modal) fechar();
        });

        modal.querySelector('#form-criar-categoria').addEventListener('submit', function (evento) {
            evento.preventDefault();
            const dados = new FormData(evento.target);

            fetch('../../back/adicionar-categoria.php', {
                method: 'POST',
                headers: { Accept: 'application/json' },
                body: dados
            })
                .then(verificarResposta)
                .then(function () {
                    evento.target.reset();
                    carregarCategoriasEmLista(modal.querySelector('#lista-categorias'));
                    carregarProdutos();
                    alert('Categoria criada com sucesso!');
                })
                .catch(function (erro) {
                    console.error(erro);
                    alert(erro.message || 'Não foi possível criar a categoria.');
                });
        });

        carregarCategoriasEmLista(modal.querySelector('#lista-categorias'));
        document.body.appendChild(modal);
        modal.querySelector('input').focus();
    });
}

function carregarCategoriasEmLista(listaElement) {
    fetch('../../back/listar-categorias.php', {
        headers: { Accept: 'application/json' }
    })
        .then(function (resposta) {
            if (!resposta.ok) {
                throw new Error('Falha ao carregar categorias.');
            }
            return resposta.json();
        })
        .then(function (categorias) {
            listaElement.innerHTML = '';

            if (!categorias.length) {
                listaElement.innerHTML = '<li class="lista-categoria-vazia">Nenhuma categoria cadastrada.</li>';
                return;
            }

            categorias.forEach(function (categoria) {
                const item = document.createElement('li');
                item.className = 'categoria-item';
                item.innerHTML = `
                    <span>${escaparHtml(categoria.nome)}</span>
                    <div class="categoria-acoes">
                        <button type="button" class="botao-produto categoria-editar">Editar</button>
                        <button type="button" class="botao-produto categoria-excluir">Excluir</button>
                    </div>
                `;

                item.querySelector('.categoria-editar').addEventListener('click', function () {
                    editarCategoria(categoria, listaElement);
                });

                item.querySelector('.categoria-excluir').addEventListener('click', function () {
                    excluirCategoria(categoria, listaElement);
                });

                listaElement.appendChild(item);
            });
        })
        .catch(function (erro) {
            console.error(erro);
            listaElement.innerHTML = '<li class="lista-categoria-vazia">Não foi possível carregar as categorias.</li>';
        });
}

function editarCategoria(categoria, listaElement) {
    const nomeNovo = prompt('Digite o novo nome da categoria:', categoria.nome);
    if (nomeNovo === null) {
        return;
    }

    const nome = nomeNovo.trim();
    if (!nome) {
        alert('O nome da categoria não pode ficar vazio.');
        return;
    }

    const dados = new FormData();
    dados.append('idcategoria', categoria.idcategoria);
    dados.append('nome', nome);

    fetch('../../back/editar-categoria.php', {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: dados
    })
        .then(verificarResposta)
        .then(function () {
            carregarCategoriasEmLista(listaElement);
            carregarProdutos();
            alert('Categoria atualizada com sucesso!');
        })
        .catch(function (erro) {
            console.error(erro);
            alert(erro.message || 'Não foi possível editar a categoria.');
        });
}

function excluirCategoria(categoria, listaElement) {
    if (!confirm(`Deseja excluir a categoria "${categoria.nome}"?`)) {
        return;
    }

    const dados = new FormData();
    dados.append('idcategoria', categoria.idcategoria);

    fetch('../../back/remover-categoria.php', {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: dados
    })
        .then(verificarResposta)
        .then(function () {
            carregarCategoriasEmLista(listaElement);
            carregarProdutos();
            alert('Categoria removida com sucesso!');
        })
        .catch(function (erro) {
            console.error(erro);
            alert(erro.message || 'Não foi possível excluir a categoria.');
        });
}

function carregarProdutos() {
    const container = document.getElementById('container-produtos');

    if (!container) {
        return;
    }

    fetch('../../back/ler-produtos.php?carregar=1')
        .then(function (resposta) {
            if (!resposta.ok) {
                throw new Error('Falha ao carregar produtos.');
            }

            return resposta.json();
        })
        .then(function (produtos) {
            container.replaceChildren();

            if (container.dataset.admin === 'true') {
                container.appendChild(criarCardAdicionar());
            }

            if (!produtos.length) {
                const aviso = document.createElement('p');
                aviso.textContent = 'Nenhum produto cadastrado.';
                container.appendChild(aviso);
                return;
            }

            produtos.forEach(function (produto) {
                container.appendChild(criarCardProduto(produto));
            });
        })
        .catch(function (erro) {
            console.error(erro);
            container.textContent = 'Não foi possível carregar os produtos.';
        });
}

function criarCardAdicionar() {
    const card = document.createElement('article');
    card.className = 'card card-adicionar';
    card.innerHTML = '<h3>Adicionar</h3><p>Cadastrar novo produto</p>';
    card.addEventListener('click', abrirFormularioAdicionar);
    return card;
}

function abrirFormularioAdicionar() {
    const modal = document.createElement('div');
    modal.className = 'modal-produto';
    modal.innerHTML = `
        <div class="modal-produto-conteudo" role="dialog" aria-modal="true" aria-labelledby="titulo-adicionar">
            <button type="button" class="modal-produto-fechar" aria-label="Fechar">&times;</button>
            <h2 id="titulo-adicionar">Adicionar produto</h2>
            <form class="formulario-edicao">
                <label>Nome<input name="nome" required></label>
                <label>Valor (R$)<input name="valor" type="number" step="0.01" min="0" required></label>
                <label>Formato<input name="formato" required></label>
                <label>Espessura (cm)<input name="espessura" type="number" step="0.01" min="0" required></label>
                <label>Largura (cm)<input name="largura" type="number" step="0.01" min="0" required></label>
                <label>Altura (cm)<input name="altura" type="number" step="0.01" min="0" required></label>
                <label>Categoria<select name="idcategoria" required>
                    <option value="">Carregando categorias...</option>
                </select></label>
                <div class="modal-produto-acoes">
                    <button type="button" class="botao-produto cancelar-edicao">Cancelar</button>
                    <button type="submit" class="botao-produto salvar-edicao" disabled>Adicionar</button>
                </div>
            </form>
        </div>`;

    const fechar = function () { modal.remove(); };
    modal.querySelector('.modal-produto-fechar').addEventListener('click', fechar);
    modal.querySelector('.cancelar-edicao').addEventListener('click', fechar);
    modal.addEventListener('click', function (evento) {
        if (evento.target === modal) fechar();
    });
    modal.querySelector('form').addEventListener('submit', function (evento) {
        evento.preventDefault();
        fetch('../../back/adicionar-produtos.php', {
            method: 'POST',
            headers: { Accept: 'application/json' },
            body: new FormData(evento.target)
        })
            .then(verificarResposta)
            .then(function () {
                fechar();
                carregarProdutos();
            })
            .catch(mostrarErroProduto);
    });

    document.body.appendChild(modal);
    modal.querySelector('input').focus();

    const selectCategoria = modal.querySelector('select[name="idcategoria"]');
    const botaoAdicionar = modal.querySelector('.salvar-edicao');
    fetch('../../back/listar-categorias.php')
        .then(verificarResposta)
        .then(function (categorias) {
            selectCategoria.replaceChildren();

            categorias.forEach(function (categoria) {
                const opcao = document.createElement('option');
                opcao.value = categoria.idcategoria;
                opcao.textContent = categoria.nome;
                selectCategoria.appendChild(opcao);
            });

            if (!categorias.length) {
                throw new Error('Nenhuma categoria cadastrada.');
            }

            botaoAdicionar.disabled = false;
        })
        .catch(function (erro) {
            selectCategoria.replaceChildren();
            const opcao = document.createElement('option');
            opcao.value = '';
            opcao.textContent = 'Não foi possível carregar as categorias';
            selectCategoria.appendChild(opcao);
            mostrarErroProduto(erro);
        });
}

function criarCardProduto(produto) {
    const card = document.createElement('div');
    const categoria = normalizarCategoria(produto.categoria);

    card.className = 'card';
    card.dataset.categoria = categoria;

    const cabecalho = document.createElement('div');
    cabecalho.className = 'card-header';
    cabecalho.appendChild(criarElemento('h3', produto.nome));

    const corpo = document.createElement('div');
    corpo.className = 'card-body';
    corpo.appendChild(criarElemento('p', 'Formato: ' + produto.formato));
    corpo.appendChild(criarElemento('p', 'Espessura: ' + produto.espessura + ' cm'));
    corpo.appendChild(criarElemento('p', 'Dimensões: ' + produto.largura + ' x ' + produto.altura + ' cm'));

    const rodape = document.createElement('div');
    rodape.className = 'card-footer';
    rodape.appendChild(criarElemento('p', formatarPreco(produto.valor)));

    if (document.getElementById('container-produtos').dataset.admin === 'true') {
        const acoes = document.createElement('div');
        acoes.className = 'card-acoes';

        const editar = criarBotao('Editar', function () {
            editarProduto(produto);
        });
        const excluir = criarBotao('Excluir', function () {
            excluirProduto(produto.idprodutos, card);
        });

        acoes.appendChild(editar);
        acoes.appendChild(excluir);
        rodape.appendChild(acoes);
    }

    card.appendChild(cabecalho);
    card.appendChild(corpo);
    card.appendChild(rodape);
    return card;
}

function criarBotao(texto, aoClicar) {
    const botao = document.createElement('button');
    botao.type = 'button';
    botao.className = 'botao-produto';
    botao.textContent = texto;
    botao.addEventListener('click', aoClicar);
    return botao;
}

function excluirProduto(id, card) {
    if (!confirm('Deseja excluir este produto?')) {
        return;
    }

    const dados = new FormData();
    dados.append('idDelete', id);

    fetch('../../back/remover-produtos.php', {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: dados
    })
        .then(verificarResposta)
        .then(function () {
            card.remove();
        })
        .catch(mostrarErroProduto);
}

function editarProduto(produto) {
    const modal = document.createElement('div');
    modal.className = 'modal-produto';
    modal.innerHTML = `
        <div class="modal-produto-conteudo" role="dialog" aria-modal="true" aria-labelledby="titulo-edicao">
            <button type="button" class="modal-produto-fechar" aria-label="Fechar">&times;</button>
            <h2 id="titulo-edicao">Editar produto</h2>
            <form class="formulario-edicao">
                <label>Nome<input name="nome" value="${escaparHtml(produto.nome)}" required></label>
                <label>Valor<input name="valor" type="number" step="0.01" min="0" value="${produto.valor}" required></label>
                <label>Formato<input name="formato" value="${escaparHtml(produto.formato)}" required></label>
                <label>Categoria<select name="idcategoria" required><option value="">Carregando categorias...</option></select></label>
                <label>Espessura (cm)<input name="espessura" type="number" step="0.01" min="0" value="${produto.espessura}" required></label>
                <label>Largura (cm)<input name="largura" type="number" step="0.01" min="0" value="${produto.largura}" required></label>
                <label>Altura (cm)<input name="altura" type="number" step="0.01" min="0" value="${produto.altura}" required></label>
                <div class="modal-produto-acoes">
                    <button type="button" class="botao-produto cancelar-edicao">Cancelar</button>
                    <button type="submit" class="botao-produto salvar-edicao">Salvar</button>
                </div>
            </form>
        </div>`;

    const fechar = function () { modal.remove(); };
    modal.querySelector('.modal-produto-fechar').addEventListener('click', fechar);
    modal.querySelector('.cancelar-edicao').addEventListener('click', fechar);
    modal.addEventListener('click', function (evento) {
        if (evento.target === modal) fechar();
    });
    modal.querySelector('form').addEventListener('submit', function (evento) {
        evento.preventDefault();
        const dados = new FormData(evento.target);
        dados.append('idprodutos', produto.idprodutos);
        fetch('../../back/editar-produtos.php', {
            method: 'POST',
            headers: { Accept: 'application/json' },
            body: dados
        })
            .then(verificarResposta)
            .then(function () {
                fechar();
                carregarProdutos();
            })
            .catch(mostrarErroProduto);
    });

    document.body.appendChild(modal);
    modal.querySelector('input').focus();
    carregarCategorias(modal.querySelector('select'), produto.idcategoria);
}

function carregarCategorias(select, categoriaAtual) {
    fetch('../../back/listar-categorias.php')
        .then(verificarResposta)
        .then(function (categorias) {
            select.replaceChildren();
            categorias.forEach(function (categoria) {
                const opcao = document.createElement('option');
                opcao.value = categoria.idcategoria;
                opcao.textContent = categoria.nome;
                opcao.selected = Number(categoria.idcategoria) === Number(categoriaAtual);
                select.appendChild(opcao);
            });
        })
        .catch(function (erro) {
            select.replaceChildren(new Option('Não foi possível carregar', ''));
            mostrarErroProduto(erro);
        });
}

function escaparHtml(valor) {
    return String(valor)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}

function verificarResposta(resposta) {
    if (!resposta.ok) {
        return resposta.json().then(function (erro) {
            throw new Error(erro.erro || 'Não foi possível concluir a operação.');
        });
    }

    return resposta.json();
}

function mostrarErroProduto(erro) {
    console.error(erro);
    alert(erro.message || 'Não foi possível concluir a operação.');
}

function normalizarCategoria(categoria) {
    const texto = String(categoria || '')
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

function criarElemento(tag, texto) {
    const elemento = document.createElement(tag);
    elemento.textContent = texto;
    return elemento;
}

function formatarPreco(valor) {
    return Number(valor).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });
}
