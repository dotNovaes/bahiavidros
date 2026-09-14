function validarCampoVazio(entrada) {
    if (entrada.trim() === '') {
        alert('Campo vazio.');
        return false;
    }

    return true;
}

function validarNome(entrada) {
    if (!validarCampoVazio(entrada)) {
        return false;
    }

    const nome = entrada.trim();

    if (!/^[A-Za-zÀ-ÿ ]+$/.test(nome)) {
        alert('Caracteres inválidos.');
        return false;
    }

    return true;
}

function validarTamanho(entrada, tamanho) {
    if (entrada.length > tamanho) {
        alert('Tamanho excedido.');
        return false;
    }

    return true;
}

function validarApenasNumeros(entrada) {
    if (entrada.trim() === '' || !/^\d+$/.test(entrada)) {
        alert('Caracteres inválidos.');
        return false;
    }

    return true;
}

function validarEmail(entrada) {
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailValido.test(entrada.trim())) {
        alert('E-mail inválido.');
        return false;
    }

    return true;
}

document.getElementById('receba-email').addEventListener('submit', function (event) {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const assunto = document.getElementById('assunto').value;

    const formularioValido =
        validarNome(nome) &&
        validarTamanho(nome, 100) &&
        validarCampoVazio(email) &&
        validarEmail(email) &&
        validarCampoVazio(assunto);

    if (formularioValido) {
        this.submit();
    }
});