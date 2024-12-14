<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id_producto = intval($_POST['id_producto']); // Asegúrate de que es un número

    // Consulta para obtener los datos del producto
    $sql = "SELECT id_producto, nombre_producto, precio_publico FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($producto = $resultado->fetch_assoc()) {
        // Añadir el producto al carrito (almacénalo en la sesión)
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verificar si el producto ya está en el carrito
        $productoEnCarrito = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id_producto'] === $id_producto) {
                $item['cantidad']++;
                $productoEnCarrito = true;
                break;
            }
        }

        // Si no está, agregarlo como nuevo
        if (!$productoEnCarrito) {
            $producto['cantidad'] = 1; // Inicializar cantidad
            $_SESSION['carrito'][] = $producto;
        }

        // Redirigir al carrito o a la página anterior
        header('Location: ../carrito.php');
        exit();
    } else {
        echo "No se encontró el producto.";
    }

    $stmt->close();
    $conn->close();
}
