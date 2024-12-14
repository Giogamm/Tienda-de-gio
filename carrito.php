
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/carrito.css">
    <title>Carrito</title>
</head>

<body>
    <header class="header">
        <section class="section-menu">
            <div class="logo-menu" id="logoMenu">
                <?php include_once 'assets/logos/logo_menu.svg'; ?>
            </div>
            <a href="./index.php" class="logo-regresar" id="logoRegresar">
                <?php include_once 'assets/logos/logo_regresar.svg'; ?>
            </a>
        </section>

        <section class="header-tittle">
            <h2>Carrito</h2>
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

    <div class="carrito-container">
        <?php
            session_start();

            // Verificar si el carrito existe
            $carrito = $_SESSION['carrito'] ?? [];
            $total = 0;
        ?>

        <div class="carrito-container">
            <h2>Tu Carrito</h2>
            <?php if (empty($carrito)) : ?>
                <p>El carrito está vacío.</p>
            <?php else : ?>
                <table class="carrito-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $precioTotal = 0;
                        foreach ($carrito as $index => $producto):
                            $total = $producto['precio_publico'] * $producto['cantidad'];
                            $precioTotal += $total;
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                                <td>$<?= number_format($producto['precio_publico'], 2) ?></td>
                                <td><?= $producto['cantidad'] ?></td>
                                <td>$<?= number_format($total, 2) ?></td>
                                <td>
                                    <form method="POST" action="include/eliminar_producto.php" class="form-eliminar">
                                        <input type="hidden" name="index" value="<?= $index ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="carrito-total">
                    <p><strong>Precio Total:</strong> $<?= number_format($precioTotal, 2) ?></p>
                </div>
                <div class="carrito-acciones">
                    <form method="POST" action="include/vaciar_carrito.php" class="form-vaciar">
                        <button type="submit" class="btn-vaciar">Vaciar carrito</button>
                    </form>
                    <form method="POST" action="include/generar_ticket.php" class="form-ticket">
                        <button type="submit" class="btn-ticket">Generar Ticket</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

    </div>



    <script type="module" src="./include/menu.js"></script>
</body>

</html>