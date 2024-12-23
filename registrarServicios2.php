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
    <?php
require 'conexion.php';

if (isset($_POST['descripcion'], $_POST['precio'], $_POST['id_bicicleta'])) {
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $id_bicicleta = $_POST['id_bicicleta'];

    $sql = "INSERT INTO servicios (Descripcion, Precio, Fecha, ID_Bicicleta) VALUES (?, ?, NOW(), ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sdi", $descripcion, $precio, $id_bicicleta);

    if ($stmt->execute()) {
        // Update owner of the bicycle to reflect the new service
        $updateOwnerSql = "UPDATE bicicletas SET ID_Cliente = 
                           (SELECT ID_Cliente FROM bicicletas WHERE ID_Bicicleta = ?) 
                           WHERE ID_Bicicleta = ?";
        $stmtOwner = $mysqli->prepare($updateOwnerSql);
        $stmtOwner->bind_param("ii", $id_bicicleta, $id_bicicleta);
        $stmtOwner->execute();

        echo "<div class='alert alert-success text-center'>Servicio registrado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al registrar el servicio.</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>Datos incompletos. Verifique e intente nuevamente.</div>";
}
?>
<div class="text-center mt-3">
    <a href="servicios.php" class="btn btn-primary">Regresar</a>
</div>

    </div>
</div>
</body>
</html>
