<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="icon" href="images/iconoBici.jpeg" type="image/jpeg">
    <title>Registrar Servicio</title>
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
        <h1 class="text-center">Registrar Servicio</h1>
        <form action="registrarServicios2.php" method="post">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del Servicio</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Introduce la descripción" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Introduce el precio del servicio" min="0" required>
            </div>
            <div class="form-group">
                        <label for="id_bicicleta">Seleccionar Bicicleta</label>
                        <select name="id_bicicleta" id="id_bicicleta" class="form-control">
                            <option value="">-- Selecciona una bicicleta --</option>
                            <?php
                            require 'conexion.php';
                            $sql = "SELECT id_bicicleta, Marca, Modelo FROM bicicletas WHERE ID_Cliente IS NOT NULL";
                            $resultado = $mysqli->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option value='{$fila['id_bicicleta']}'>#{$fila['id_bicicleta']} - {$fila['Marca']} {$fila['Modelo']}</option>";
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
</body>
</html>
