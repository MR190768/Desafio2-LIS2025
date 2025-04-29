<div class="modal fade modal-lg" id="modalP" tabindex="-1" aria-labelledby="modalP" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="codigo"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <main>
          <div class="card">
            <br>
            <div class="card__body">
              <div class="half">
                <div class="featured_text">
                  <h1 id="nombre" style=" font-size: 45px; text-align: center;">Ejemplo</h1>
                  <p class="sub" id="precio" style=" text-align: center;">$0.00</p>
                </div>
                <div class="image">
                  <img src="" alt="" id="imagen" style=" width: 350px; height: 400px;">
                </div>
              </div>
              <div class="half">
                <div class="description" >
                  <p id="descripcion"></p>
                </div>
                <span class="cate" id="categoria">Categoria:</span>
                <br>
                <span class="stock" id="existencias">Quedan </span>
                <br>
                <br>
                <form action="<?=PATH?>productos/addCarrito" method="post">
                <input type="hidden" name="codigo" id="codigoInput">
                <input type="hidden" name="nombre" id="nombreInput">
                <input type="hidden" name="precio" id="precioInput">
                <input type="hidden" name="imagen" id="imagenInput">
                <label for="cant">Cantida:</label>
                <input type="number" name="cantidad" id="cantidad">
                <br>
                <br>
                <button class="btn btn-dark btn-lg" style="background-color:rgb(35, 2, 75) !important;" type="submit" id="addCarrito">Agregar al Carrito<i class="bi bi-cart-plus"></i></button>
              </form>
              </div>
            </div>
          </div>
        </main>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>