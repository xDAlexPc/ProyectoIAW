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
        <h1 class="text-center">Registrar Operación</h1>
        <form action="registrarOperacion2.php" method="post">
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Operación</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="">-- Selecciona el tipo de operación --</option>
                    <option value="Compra">Compra</option>
                    <option value="Venta">Venta</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_bicicleta" class="form-label">Bicicleta</label>
                <select class="form-control" id="id_bicicleta" name="id_bicicleta" required>
                    <option value="">-- Selecciona una bicicleta --</option>
                    <?php
                    require 'conexion.php';
                    $sql = "SELECT id_bicicleta, Marca, Modelo FROM bicicletas";
                    $resultado = $mysqli->query($sql);
                    if ($resultado && $resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<option value='{$fila['id_bicicleta']}'>{$fila['Marca']} - {$fila['Modelo']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
            </div>
            <div class="mb-3" id="clienteField" style="display: none;">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select class="form-control" id="id_cliente" name="id_cliente">
                    <option value="" selected disabled>-- Selecciona un cliente --</option>
                    <?php
                    $sqlClientes = "SELECT id_cliente, Nombre FROM clientes";
                    $resultadoClientes = $mysqli->query($sqlClientes);
                    if ($resultadoClientes && $resultadoClientes->num_rows > 0) {
                        while ($cliente = $resultadoClientes->fetch_assoc()) {
                            echo "<option value='{$cliente['id_cliente']}'>{$cliente['Nombre']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('tipo').addEventListener('change', function () {
        const tipo = this.value;
        const clienteField = document.getElementById('clienteField');
        const clienteSelect = document.getElementById('id_cliente');
        if (tipo === 'Venta') {
            clienteField.style.display = 'block';
            clienteSelect.required = true;
        } else {
            clienteField.style.display = 'none';
            clienteSelect.required = false;
        }
    });
</script>
</body>
</html>