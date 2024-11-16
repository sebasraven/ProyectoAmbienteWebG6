// JavaScript para manejar la selección de cards y mostrar el formulario
document.addEventListener('DOMContentLoaded', function () {
    const seleccionarBtns = document.querySelectorAll('.seleccionar-btn');
    const formularioDenuncia = document.getElementById('formularioDenuncia');
    const tituloFormulario = document.getElementById('tituloFormulario');
    const cards = document.querySelectorAll('.card');

    seleccionarBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            // Remover la clase 'seleccionada' de todas las cards
            cards.forEach(function (card) {
                card.classList.remove('seleccionada');
            });

            // Agregar la clase 'seleccionada' a la card correspondiente
            const card = this.closest('.card');
            card.classList.add('seleccionada');

            // Mostrar el formulario
            formularioDenuncia.style.display = 'block';

            // Actualizar el título del formulario con el tipo de denuncia seleccionado
            const tipoDenuncia = this.getAttribute('data-tipo');
            tituloFormulario.textContent = 'Denuncia de: ' + tipoDenuncia;

            // Opcional: Guardar el tipo de denuncia seleccionado en un campo oculto
            // para enviarlo junto con el formulario
            // Por ejemplo:
            // document.getElementById('tipoDenunciaInput').value = tipoDenuncia;

            // Desplazarse suavemente hasta el formulario
            formularioDenuncia.scrollIntoView({ behavior: 'smooth' });
        });
    });
});
