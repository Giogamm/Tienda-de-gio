document.addEventListener("DOMContentLoaded", () => {
  // Toggle para mostrar/ocultar el formulario de añadir producto
  document
    .getElementById("toggleFormularioProducto")
    .addEventListener("click", () => {
      const formularioProducto = document.getElementById("formularioProducto");
      // Cambia el display entre 'flex' y 'none'
      if (formularioProducto.style.display === "flex") {
        formularioProducto.style.display = "none"; // Ocultar
      } else {
        formularioProducto.style.display = "flex"; // Mostrar
        formularioProducto.classList.add("mostrar"); // Activar la animación de aparición
      }
    });

  // Botón de cerrar modal
  document.getElementById("cerrarModal").addEventListener("click", () => {
    const formularioProducto = document.getElementById("formularioProducto");
    formularioProducto.style.display = "none"; // Ocultar modal
    formularioProducto.classList.remove("mostrar"); // Eliminar la animación
  });
});
