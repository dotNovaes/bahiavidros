document.addEventListener('DOMContentLoaded', function () {
    const footerImage = document.querySelector('.footer img');

    if (!footerImage) {
        return;
    }

    const imagemOriginal = footerImage.getAttribute('src');
    const imagemAlternativa = '/src/imagens/craquinho.png';
    let temporizador;

    footerImage.addEventListener('mouseenter', function () {
        temporizador = setTimeout(function () {
            footerImage.setAttribute('src', imagemAlternativa);
        }, 3000);
    });

    footerImage.addEventListener('mouseleave', function () {
        clearTimeout(temporizador);
        footerImage.setAttribute('src', imagemOriginal);
    });
});
