<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="icon" href="images/iconoBici.jpeg" type="image/jpeg">
    <title>Editar Bicicleta</title>
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

        $id = $_GET['id'];
        $sql = "SELECT * FROM bicicletas WHERE ID_Bicicleta = '$id'";
        $resultado = $mysqli->query($sql);
        $row = $resultado->fetch_assoc();
        ?>
        <h1 class="text-center">Editar Bicicleta</h1>
        <form action="editarBicicletas2.php" method="post">
            <input type="hidden" name="id" value="<?= $row['ID_Bicicleta'] ?>">
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?= $row['Marca'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $row['Modelo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="Montaña" <?= $row['Tipo'] === 'Montaña' ? 'selected' : '' ?>>Montaña</option>
                    <option value="Carretera" <?= $row['Tipo'] === 'Carretera' ? 'selected' : '' ?>>Carretera</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" min="0" value="<?= $row['Precio'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?= $row['Stock'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Seleccionar Cliente</label>
                <select class="form-control" id="id_cliente" name="id_cliente">
                    <option value="">-- Sin dueño --</option>
                    <?php
                    $sqlClientes = "SELECT id_cliente, Nombre FROM clientes";
                    $resultadoClientes = $mysqli->query($sqlClientes);
                    while ($cliente = $resultadoClientes->fetch_assoc()) {
                        $selected = $row['ID_Cliente'] == $cliente['id_cliente'] ? 'selected' : '';
                        echo "<option value='{$cliente['id_cliente']}' $selected>{$cliente['Nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
