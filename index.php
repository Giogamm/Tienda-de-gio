<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La mejor tienda de la ciudad vdd de dios q si">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Tienda de gio</title>
</head>
<?php
require_once 'include/conexion.php';
?>

<body>
    <header class="header">
        <section class="section-menu">
            <div class="logo-menu" id="logoMenu">
                <?php include_once 'assets/logos/logo_menu.svg'; ?>
            </div>
            <a href="./carrito.php" class="logo-carrito" id="logoCarrito">
                <?php include_once 'assets/logos/logo_carrito.svg'; ?>
            </a>
        </section>

        <section class="add-product">
            <button class="btn-add-prod" id="toggleFormularioProducto">Añadir producto</button>
        </section>

        <h2>TIENDA DE PRODUCTOS ELECTRÓNICOS</h2>
        <section class="buscador">
            <form id="form-buscador">
                <input type="text" id="buscador" name="buscador" placeholder="Buscar producto..." autocomplete="off">
            </form>
            <?php include_once 'assets/logos/logo_buscar.svg'; ?>
        </section>
    </header>
    
    <aside id="sidebar" class="sidebar">
        <section id="closeSidebar" class="close-sidebar">
            <?php include_once 'assets/logos/logo_salir.svg'; ?>
        </section>
        <header class="sidebar-header">
            <h2>MENÚ</h2>
        </header>

        <ul>
            <li><a href="">Iniciar sesión</a></li>
            <li><a href="">Proveedores</a></li>
            <li><a href="">Productos</a></li>
        </ul>
    </aside>

    <!-- para aparecer los productos pq si no me confundo -->
    <section class="producto-container">
  <?php require_once 'include/productos.php'; ?>
    </section>

    <section id="formularioProducto" class="formulario-producto ">
        <div class="modal-content">
            <button type="button" id="cerrarModal" class="btn-close-modal">X</button>
            <h3>Añadir Producto</h3>
            <form method="POST" action="./include/añadir_producto.php" enctype="multipart/form-data">
                <input type="text" name="nombre_producto" class="input-nombre-producto" placeholder="Nombre del producto" required>
                <input type="number" name="precio_publico" class="input-precio-producto" placeholder="Precio" required>
                <input type="file" name="imagen" class="input-imagen-producto" accept="image/*" required>
                <button type="submit" class="btn-guardar-producto">Guardar Producto</button>
            </form>
        </div>
    </section>


    <!-- que magaly haga el cartel  😊👍🏿  -->
    <script type="module" src="./include/buscador.js"></script>
    <script type="module" src="./include/menu.js"></script>
    <script type="module" src="./include/main.js"></script>
</body>

</html>