<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];

    // Eliminar todas las ventas asociadas al producto
    $sqlDeleteVentas = "DELETE FROM ventas WHERE id_producto = ?";
    $stmtVentas = $conn->prepare($sqlDeleteVentas);
    $stmtVentas->bind_param("i", $id_producto);

    if ($stmtVentas->execute()) {
        // Si las ventas fueron eliminadas, proceder con el producto
        $sqlDeleteProducto = "DELETE FROM productos WHERE id_producto = ?";
        $stmtProducto = $conn->prepare($sqlDeleteProducto);
        $stmtProducto->bind_param("i", $id_producto);

        if ($stmtProducto->execute()) {
            // Redirige a la misma página para actualizarla
            header("Location: ../index.php");
            exit(); // Aseguramos que no se ejecute más código después de la redirección
        } else {
            echo "Error al eliminar el producto.";
        }

        $stmtProducto->close();
    } else {
        echo "Error al eliminar las ventas asociadas.";
    }

    $stmtVentas->close();
    $conn->close();
}
?>
