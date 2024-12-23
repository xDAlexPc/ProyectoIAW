<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="icon" href="images/iconoBici.jpeg" type="image/jpeg">
    <title>Registrar Operación</title>
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 50px;
            margin-right: 10px;
        }
        .menu-toggle {
            font-size: 24px;
            cursor: pointer;
        }
        .menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .menu a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }
        .menu a:hover {
            background-color: #f0f0f0;
        }
        .container {
            margin-top: 20px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">
        <a href="index.php">
            <img src="images/iconoBici.jpeg" alt="Logo">
        </a>
        <h1>ReparaBike</h1>
    </div>
    <div class="menu-toggle" id="menuToggle">&#9776;</div>
</div>
<div class="menu" id="menu">
    <a href="bicicletas.php">Bicicletas</a>
    <a href="clientes.php">Clientes</a>
    <a href="servicios.php">Servicios</a>
    <a href="operaciones.php">Operaciones</a>
</div>
<script>
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.getElementById('menu');
    menuToggle.addEventListener('click', () => {
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
</script>
<div class="container">
    <div class="form-container">
        <?php
        require 'conexion.php';

        if (isset($_POST['tipo'], $_POST['id_bicicleta'], $_POST['cantidad'])) {
            $tipo = $_POST['tipo'];
            $id_bicicleta = intval($_POST['id_bicicleta']);
            $cantidad = intval($_POST['cantidad']);
            $id_cliente = ($tipo === "Venta") ? intval($_POST['id_cliente']) : 0;

            if ($cantidad <= 0) {
                $mensaje = "Error: La cantidad debe ser mayor a cero.";
                $clase = "danger";
            } else {
                $sqlStock = "SELECT Stock, Precio FROM bicicletas WHERE id_bicicleta = ?";
                $stmtStock = $mysqli->prepare($sqlStock);
                $stmtStock->bind_param("i", $id_bicicleta);
                $stmtStock->execute();
                $resultStock = $stmtStock->get_result();

                if ($resultStock->num_rows > 0) {
                    $row = $resultStock->fetch_assoc();
                    $stockActual = $row['Stock'];
                    $precio = $row['Precio'];

                    if ($tipo === "Venta" && $cantidad > $stockActual) {
                        $mensaje = "Error: La cantidad solicitada excede el stock disponible.";
                        $clase = "danger";
                    } else {
                        $nuevoStock = ($tipo === "Venta") ? $stockActual - $cantidad : $stockActual + $cantidad;

                        $sqlUpdateStock = "UPDATE bicicletas SET Stock = ? WHERE id_bicicleta = ?";
                        $stmtUpdateStock = $mysqli->prepare($sqlUpdateStock);
                        $stmtUpdateStock->bind_param("ii", $nuevoStock, $id_bicicleta);

                        if ($stmtUpdateStock->execute()) {
                            $coste = $precio * $cantidad;
                            $sqlInsertOperacion = "INSERT INTO operaciones (tipo, id_bicicleta, id_cliente, cantidad, coste, fecha) 
                                                   VALUES (?, ?, ?, ?, ?, NOW())";
                            $stmtInsertOperacion = $mysqli->prepare($sqlInsertOperacion);
                            $stmtInsertOperacion->bind_param("siidi", $tipo, $id_bicicleta, $id_cliente, $cantidad, $coste);

                            if ($stmtInsertOperacion->execute()) {
                                $mensaje = "Operación registrada con éxito.";
                                $clase = "success";
                            } else {
                                $mensaje = "Error al registrar la operación.";
                                $clase = "danger";
                            }
                        } else {
                            $mensaje = "Error al actualizar el stock.";
                            $clase = "danger";
                        }
                    }
                } else {
                    $mensaje = "No se encontró la bicicleta seleccionada.";
                    $clase = "danger";
                }
            }
        } else {
            $mensaje = "Error: Datos incompletos para realizar la operación.";
            $clase = "danger";
        }
        ?>
        <div class="text-center mt-5">
            <div class="alert alert-<?= $clase ?>"><?= $mensaje ?></div>
            <a href="operaciones.php" class="btn btn-primary">Regresar</a>
        </div>
    </div>
</div>
</body>
</html>
