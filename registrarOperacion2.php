<?php
require 'conexion.php';

// Verificar si se han enviado todos los datos necesarios
if (isset($_POST['tipo'], $_POST['id_bicicleta'], $_POST['cantidad'])) {
    $tipo = $_POST['tipo'];
    $id_bicicleta = $_POST['id_bicicleta'];
    $cantidad = $_POST['cantidad'];
    $id_cliente = $_POST['id_cliente'] ?? null;

    // Verificar que la cantidad sea un número válido y positivo
    if ($cantidad <= 0) {
        echo "Error: La cantidad debe ser mayor a cero.";
        exit;
    }

    // Obtener el stock actual de la bicicleta
    $sqlStock = "SELECT Stock FROM bicicletas WHERE id_bicicleta = ?";
    $stmtStock = $mysqli->prepare($sqlStock);
    $stmtStock->bind_param("i", $id_bicicleta);
    $stmtStock->execute();
    $resultStock = $stmtStock->get_result();

    if ($resultStock->num_rows > 0) {
        $row = $resultStock->fetch_assoc();
        $stockActual = $row['Stock'];

        // Verificar que la cantidad no exceda el stock disponible
        if ($cantidad > $stockActual) {
            echo "Error: La cantidad solicitada excede el stock disponible.";
            exit;
        }

        // Restar la cantidad al stock
        $nuevoStock = $stockActual - $cantidad;
        $sqlUpdateStock = "UPDATE bicicletas SET Stock = ? WHERE id_bicicleta = ?";
        $stmtUpdateStock = $mysqli->prepare($sqlUpdateStock);
        $stmtUpdateStock->bind_param("ii", $nuevoStock, $id_bicicleta);

        if (!$stmtUpdateStock->execute()) {
            echo "Error al actualizar el stock.";
            exit;
        }

        // Registrar la operación
        $sqlInsertOperacion = "INSERT INTO operaciones (tipo, id_bicicleta, id_cliente, cantidad, coste) 
                               VALUES (?, ?, ?, ?, (SELECT Precio FROM bicicletas WHERE id_bicicleta = ?) * ?)";
        $stmtInsertOperacion = $mysqli->prepare($sqlInsertOperacion);
        $stmtInsertOperacion->bind_param("siidii", $tipo, $id_bicicleta, $id_cliente, $cantidad, $id_bicicleta, $cantidad);

        if ($stmtInsertOperacion->execute()) {
            ?>
            <br>
            <p class="alert alert-primary">REGISTRO REALIZADO</p>
              <br>
            <p><a href="index.php" class="btn btn-primary">Regresar</a></p>

    <?php
        } else {
    ?>  
            <br>
              <p class="alert alert-danger">FALLO EN EL REGISTRO</p>
            <br>  
            <p><a href="registrar.php" class="btn btn-primary">Regresar al resgistro</a></p>
            <p><a href="index.php" class="btn btn-primary">Regresar a la pagina principal</a></p>
    <?php		
        }
        } else {
            ?>  
            <br>
              <p class="alert alert-danger">FALTAN DATOS</p>
            <br>  
            <p><a href="registrarOperacion.php" class="btn btn-primary">Regresar al resgistro</a></p>
    <?php		
}
}

$mysqli->close();
?>
