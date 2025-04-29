
codigo = document.getElementById("codigo");
addCarrito= document.getElementById("addCarrito");
codigoInput = document.getElementById("codigoInput");
nombreInput = document.getElementById("nombreInput");
imagenInput = document.getElementById("imagenInput");
precioInput = document.getElementById("precioInput");
nombre = document.getElementById("nombre");
descripcion = document.getElementById("descripcion");
imagen = document.getElementById("imagen");
categoria = document.getElementById("categoria");
precio = document.getElementById("precio");
existencias = document.getElementById("existencias");
modales = document.querySelectorAll(".Amodal");

modales.forEach(modal => {
    modal.addEventListener("click", function () {
        datos = modal.getElementsByTagName("label");
        codigo.textContent = datos[0].textContent;
        codigoInput.value = datos[0].textContent;
        nombreInput.value = modal.querySelector("#name").textContent;
        nombre.textContent = modal.querySelector("#name").textContent;
        descripcion.textContent = datos[1].textContent;
        imagen.setAttribute("src", datos[2].textContent)
        imagenInput.value = datos[2].textContent;
        categoria.textContent = datos[3].textContent;
        precio.textContent = modal.querySelector("#price").textContent;
        precioInput.value = modal.querySelector("#price").textContent;
        if(datos[4].textContent == "0") {
            addCarrito.disabled = true;
            existencias.textContent = "Agotado";
        }
        else{
            existencias.textContent = "Quedan: " + datos[4].textContent;
            addCarrito.disabled = false;
        }

    })

});


