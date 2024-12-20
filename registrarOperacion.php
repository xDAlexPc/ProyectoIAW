<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaBike</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="images/iconoBici.jpeg" type="image/jpeg">
    <style>
        body {
            background: url('images/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0; 
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
    <?php require 'conexion.php'; ?>
    <div class="container">
        <div class="row">
            <h1>Nueva Operación</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-container">
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

                        <div class="form-group" id="clienteField" style="display: none;">
                            <label for="id_cliente">Cliente</label>
                            <select name="id_cliente" id="id_cliente" class="form-control">
                                <option value="">-- Selecciona un cliente --</option>
                                <?php
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

                        <input type="hidden" id="id_cliente_compra" name="id_cliente" value="0">

                        <div class="form-group">
                            <input type="submit" value="Registrar Operación" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tipo').on('change', function () {
                const tipo = $(this).val();

                if (tipo === 'Venta') {
                    $('#clienteField').show();
                    $('#id_cliente_compra').val(''); // Limpiar id_cliente para venta
                } else {
                    $('#clienteField').hide();
                    $('#id_cliente_compra').val(0); // Asignar 0 para compras
                }

                $('#id_bicicleta').val('');
                $('#precio').val('');
                $('#cantidad').val('');
                $('#stockDisponible').text('');
            });

            $('#id_bicicleta').on('change', function () {
                const selectedOption = $(this).find(':selected');
                const precio = selectedOption.data('precio') || 0;
                const stock = selectedOption.data('stock') || 0;

                $('#precio').val(precio);
                $('#cantidad').removeAttr('max'); 
                $('#stockDisponible').text(`Stock disponible: ${stock}`);
            });
        });
    </script>
</body>
</html>
