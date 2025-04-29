document.addEventListener('DOMContentLoaded', function () {
    const linksCategorias = document.querySelectorAll('.list-group-item a');
    const tarjetasProductos = document.querySelectorAll('.card');

    // Función para filtrar
    function filtrarProductos(categoriaSeleccionada) {
        tarjetasProductos.forEach(card => {
            const textoCategoria = card.querySelector('.card-text strong').textContent.trim();
            if (categoriaSeleccionada === 'Todos' || textoCategoria === categoriaSeleccionada) {
                card.parentElement.style.display = 'block'; // Mostrar
            } else {
                card.parentElement.style.display = 'none';  // Ocultar
            }
        });
    }

    // Agregar evento a cada link de categoría
    linksCategorias.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Evitar que recargue la página
            const categoria = this.textContent.trim();
            filtrarProductos(categoria);
        });
    });
});
