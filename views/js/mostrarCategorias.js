// Capturamos los botones de categorías
const botonesCategorias = document.querySelectorAll('.btnCat');
const botonTodos = document.getElementById("allprod");
const loader = document.getElementById("loader");

// Capturamos todos los productos
const productos = document.querySelectorAll("[categoria]");

// Mostrar loader y ejecutar una acción después
async function mostrarLoader(callback) {
    loader.style.display = "block";
    ocultarTodo();
    setTimeout(() => {
        callback();
        loader.style.display = "none";
    }, 500);
}

// Ocultar todos los productos
function ocultarTodo() {
    productos.forEach(prod => prod.style.display = "none");
}

// Mostrar productos por categoría
function mostrarPorCategoria(categoria) {
    productos.forEach(prod => {
        if (prod.getAttribute('categoria') === categoria) {
            prod.style.display = "block";
        }
    });
}

// Event listener para botón "Todos los productos"
botonTodos.addEventListener("click", function () {
    mostrarLoader(() => {
        productos.forEach(prod => prod.style.display = "block");
    });
});

// Event listeners para cada botón de categoría
botonesCategorias.forEach(boton => {
    boton.addEventListener("click", function () {
        const categoriaSeleccionada = this.textContent.trim();
        mostrarLoader(() => {
            mostrarPorCategoria(categoriaSeleccionada);
        });
    });
});
