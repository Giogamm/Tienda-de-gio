document.addEventListener("DOMContentLoaded", () => {
  const menu = document.getElementById("logoMenu");
  const sidebar = document.getElementById("sidebar");
  const closeSidebar = document.getElementById("closeSidebar"); // Botón de cerrar

  menu.addEventListener("click", () => {
    sidebar.classList.add("visible"); // Muestra el sidebar
   
  });

  closeSidebar.addEventListener("click", () => {
    sidebar.classList.remove("visible"); // Oculta el sidebar
  });
});
