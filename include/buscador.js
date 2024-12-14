document.addEventListener("DOMContentLoaded", () => {
  const buscador = document.getElementById("buscador");
  const productoContainer = document.querySelector(".producto-container");

  const buscarProductos = async (query) => {
    try {
      const response = await fetch(
        `include/buscar_productos.php?query=${query}`
      );
      const productos = await response.json();
      console.log(productos); // Para ver la respuesta en la consola y verificar

      productoContainer.innerHTML = productos.length
        ? productos
            .map(
              (producto) => producto.producto_html // Usar directamente el HTML generado desde PHP
            )
            .join("")
        : "<p>No se encontraron productos.</p>";
    } catch (error) {
      console.error("Error al buscar productos:", error);
    }
  };

  buscador.addEventListener("input", (e) => {
    const query = e.target.value.trim();
    if (query.length > 2 || query === "") buscarProductos(query);
  });
});
