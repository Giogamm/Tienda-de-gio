        <?php
        // Consulta inicial para mostrar todos los productos al cargar la página
        session_start();


        $sql = "SELECT id_producto, nombre_producto, precio_publico, imagen FROM productos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $imagenBase64 = base64_encode($fila['imagen']); // Codificar en Base64
                echo "<div class='producto'>";
                echo "<h3 class='producto-nombre'>" . $fila['nombre_producto'] . "</h3>";
                echo "<p class='producto-precio'>$" . $fila['precio_publico'] . "</p>";
                echo "<img src='data:image/jpeg;base64,{$imagenBase64}' alt='" . $fila['nombre_producto'] . "' class='producto-imagen'>";
                echo "<form method='POST' action='include/añadir_al_carrito.php'>";
                echo "<input type='hidden' name='id_producto' value='" . $fila['id_producto'] . "'>";
                echo "<button type='submit' class='btn-add-cart'>Añadir al carrito</button>";
                echo "</form>";
                echo "<form method='POST' action='include/eliminar_producto.php'>";
                echo "<input type='hidden' name='id_producto' value='" . $fila['id_producto'] . "'>";
                echo "<button type='submit' class='btn-delete-prod'>Eliminar producto</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }

        $stmt->close();
        $conn->close();
        