<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $precio_publico = $_POST['precio_publico'];
    $imagen = $_FILES['imagen'];

    if (!empty($imagen['tmp_name'])) {
        $imagenData = file_get_contents($imagen['tmp_name']);

        $sql = "INSERT INTO productos (nombre_producto, precio_publico, imagen) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sds", $nombre_producto, $precio_publico, $imagenData);

        if ($stmt->execute()) {
            // Redirigir al index.php después de añadir el producto
            header("Location: ../index.php"); // Asegúrate de que la ruta es correcta según tu estructura
            exit(); // Detener la ejecución del script
        } else {
            echo "Error al añadir el producto.";
        }

        $stmt->close();
    } else {
        echo "Se requiere una imagen para añadir el producto.";
    }

    $conn->close();
}
