<?php
require 'conexion.php';
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ReparaBike - Nueva Operación</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Nueva Operación</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form id="registroOperacion" name="registroOperacion" autocomplete="off" action="registrarOperacion2.php" method="post">
                    <div class="form-group">
                        <label for="tipo">Tipo de Operación</label>
                        <select name="tipo" id="tipo" class="form-control" required>
                            <option value="">-- Selecciona el tipo de operación --</option>
                            <option value="Compra">Compra</option>
                            <option value="Venta">Venta</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_bicicleta">Bicicleta</label>
                        <select name="id_bicicleta" id="id_bicicleta" class="form-control" required>
                            <option value="">-- Selecciona una bicicleta --</option>
                            <?php
                            // Obtener bicicletas de la base de datos
                            $sql = "SELECT id_bicicleta, Marca, Modelo, Precio, Stock FROM bicicletas";
                            $resultado = $mysqli->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option 
                                            value='{$fila['id_bicicleta']}' 
                                            data-precio='{$fila['Precio']}' 
                                            data-stock='{$fila['Stock']}'>
                                            {$fila['Marca']} - {$fila['Modelo']}
                                          </option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" id="precio" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Introduce la cantidad" required>
                        <small id="stockDisponible" class="form-text text-muted"></small>
                    </div>

                    <div class="form-group">
                        <label for="id_cliente">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-control">
                            <option value="">-- Sin cliente --</option>
                            <?php
                            // Obtener clientes de la base de datos
                            $sql = "SELECT id_cliente, Nombre FROM clientes";
                            $resultado = $mysqli->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option value='{$fila['id_cliente']}'>{$fila['Nombre']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Registrar Operación" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#id_bicicleta').on('change', function () {
                // Obtener los datos del precio y stock de la bicicleta seleccionada
                const selectedOption = $(this).find(':selected');
                const precio = selectedOption.data('precio') || 0;
                const stock = selectedOption.data('stock') || 0;

                // Actualizar el campo de precio y el mensaje de stock disponible
                $('#precio').val(precio);
                $('#cantidad').attr('max', stock);
                $('#stockDisponible').text(`Stock disponible: ${stock}`);
            });
        });
    </script>
</body>
</html>
