<?php
header('Content-Type: application/json'); // Establecer el encabezado JSON
require_once 'conexion.php'; // Incluir la conexión a la base de datos

$query = $_GET['query'] ?? '';
$query = $conn->real_escape_string($query);

$sql = "SELECT id_producto, nombre_producto, precio_publico, imagen FROM productos WHERE nombre_producto LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$query%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$resultado = $stmt->get_result();

$productos = [];
while ($fila = $resultado->fetch_assoc()) {
    $imagenBase64 = !empty($fila['imagen']) ? base64_encode($fila['imagen']) : null;

    // Construcción del HTML para el producto
    $productoHtml = "<div class='producto'>";
    $productoHtml .= "<h3 class='producto-nombre'>" . $fila['nombre_producto'] . "</h3>";
    $productoHtml .= "<p class='producto-precio'>$" . $fila['precio_publico'] . "</p>";
    $productoHtml .= "<img src='data:image/jpeg;base64,{$imagenBase64}' alt='" . $fila['nombre_producto'] . "' class='producto-imagen'>";
    $productoHtml .= "<form method='POST' action='include/añadir_al_carrito.php'>";
    $productoHtml .= "<input type='hidden' name='id_producto' value='" . $fila['id_producto'] . "'>";
    $productoHtml .= "<button type='submit' class='btn-add-cart'>Añadir al carrito</button>";
    $productoHtml .= "</form>";
    $productoHtml .= "<form method='POST' action='include/eliminar_producto.php'>";
    $productoHtml .= "<input type='hidden' name='id_producto' value='" . $fila['id_producto'] . "'>";
    $productoHtml .= "<button type='submit' class='btn-delete-prod'>Eliminar producto</button>";
    $productoHtml .= "</form>";
    $productoHtml .= "</div>";

    // Añadir el HTML del producto al array
    $productos[] = [
        'id_producto' => $fila['id_producto'],
        'nombre_producto' => $fila['nombre_producto'],
        'precio_publico' => $fila['precio_publico'],
        'imagen' => $imagenBase64,
        'producto_html' => $productoHtml // Agregar el HTML aquí
    ];
}

// Enviar los productos como JSON
echo json_encode($productos);

$stmt->close();
$conn->close();
