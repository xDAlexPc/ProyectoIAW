<?php
require 'conexion.php';

if (isset($_POST['tipo'], $_POST['id_bicicleta'], $_POST['cantidad'])) {
    $tipo = $_POST['tipo'];
    $id_bicicleta = intval($_POST['id_bicicleta']);
    $cantidad = intval($_POST['cantidad']);
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : 0;

    if ($cantidad <= 0) {
        echo "<p class='alert alert-danger'>Error: La cantidad debe ser mayor a cero.</p>";
        exit;
    }

    // Obtener stock actual y precio
    $sqlStock = "SELECT Stock, Precio FROM bicicletas WHERE id_bicicleta = ?";
    $stmtStock = $mysqli->prepare($sqlStock);
    $stmtStock->bind_param("i", $id_bicicleta);
    $stmtStock->execute();
    $resultStock = $stmtStock->get_result();

    if ($resultStock->num_rows > 0) {
        $row = $resultStock->fetch_assoc();
        $stockActual = $row['Stock'];
        $precio = $row['Precio'];

        // Verificar tipo de operación
        if ($tipo === "Venta" && $cantidad > $stockActual) {
            echo "<p class='alert alert-danger'>Error: La cantidad solicitada excede el stock disponible.</p>";
            exit;
        }

        $nuevoStock = ($tipo === "Venta") ? $stockActual - $cantidad : $stockActual + $cantidad;

        // Actualizar stock
        $sqlUpdateStock = "UPDATE bicicletas SET Stock = ? WHERE id_bicicleta = ?";
        $stmtUpdateStock = $mysqli->prepare($sqlUpdateStock);
        $stmtUpdateStock->bind_param("ii", $nuevoStock, $id_bicicleta);

        if (!$stmtUpdateStock->execute()) {
            echo "<p class='alert alert-danger'>Error al actualizar el stock.</p>";
            exit;
        }

        // Insertar operación
        $coste = $precio * $cantidad;
        $sqlInsertOperacion = "INSERT INTO operaciones (tipo, id_bicicleta, id_cliente, cantidad, coste, fecha) 
                               VALUES (?, ?, ?, ?, ?, NOW())";
        $stmtInsertOperacion = $mysqli->prepare($sqlInsertOperacion);
        $stmtInsertOperacion->bind_param("siidi", $tipo, $id_bicicleta, $id_cliente, $cantidad, $coste);

        $resultado = $stmtInsertOperacion->execute();

        // Mensajes de éxito o error
        if ($resultado) {
            echo "<p class='alert alert-primary'>REGISTRO COMPLETADO</p>";
        } else {
            echo "<p class='alert alert-danger'>REGISTRO NO COMPLETADO</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>Error: No se encontró la bicicleta seleccionada.</p>";
    }
} else {
    echo "<p class='alert alert-danger'>Error: Datos incompletos para realizar la operación.</p>";
}
?>
<br>
<p><a href="index.php" class="btn btn-primary">Regresar</a></p>
