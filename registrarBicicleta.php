<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Bicicleta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="icon" href="images/iconoBici.jpeg" type="image/jpeg">
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
            z-index: 1000;
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

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem; /* Añadimos separación entre los campos */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Encabezado -->
<div class="header">
    <div class="logo">
        <a href="index.php">
            <img src="images/iconoBici.jpeg" alt="Logo">
        </a>
        <h1>ReparaBike</h1>
    </div>
    <div class="menu-toggle" id="menuToggle">&#9776;</div>
</div>

<!-- Menú desplegable -->
<div class="menu" id="menu">
    <a href="bicicletas.php">Bicicletas</a>
    <a href="clientes.php">Clientes</a>
    <a href="servicios.php">Servicios</a>
    <a href="operaciones.php">Operaciones</a>
</div>

<!-- Contenido principal -->
<div class="container mt-5">
    <h1>Registrar Bicicleta</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="form-container">
                <form action="registrarBicicleta2.php" id="registro" name="registro" autocomplete="off" method="post">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control" placeholder="Introduce la marca de la bicicleta" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Introduce el modelo de la bicicleta" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control" required>
                            <option value="">-- Selecciona el tipo de bicicleta --</option>
                            <option value="Montaña">Montaña</option>
                            <option value="Carretera">Carretera</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" min="0" class="form-control" placeholder="Introduce el precio de la bicicleta" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" min="0" class="form-control" placeholder="Introduce la cantidad de bicicletas" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_cliente">Seleccionar Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-control">
                            <option value="">-- Sin dueño --</option>
                            <?php
                                require 'conexion.php';
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
                        <input type="submit" value="Registrar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', () => {
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
