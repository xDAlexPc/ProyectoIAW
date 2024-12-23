<?php
require 'conexion.php';
$sql = "SELECT ID_Bicicleta, Marca, Modelo, Tipo, Precio, stock 
        FROM Bicicletas 
        WHERE ID_Cliente IS NULL OR stock > 1";
$resultado = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaBike - Servicios</title>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
				<h2>Servicios Ofrecidos</h2>
				<a href="registrarServicios.php" class="btn btn-primary boton">Añadir</a>
			</div>
			<?php
			$sqlServicios = "SELECT ID_Servicio, Descripcion, Precio FROM Servicios";
			$resultServicios = $mysqli->query($sqlServicios);
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Descripción</th>
						<th>Precio</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = $resultServicios->fetch_assoc()): ?>
						<tr>
							<td><?= htmlspecialchars($row['Descripcion']) ?></td>
							<td><?= htmlspecialchars($row['Precio']) ?></td>
							<td><a href="editarServicios.php?id=<?= $row['ID_Servicio'] ?>" class="btn btn-primary">Editar</a> <a href="eliminarServicios.php?id=<?= $row['ID_Servicio'] ?>" class="btn btn-danger">Eliminar</a></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>


        <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
				<h2>Servicios Realizados a Clientes</h2>
			</div>
			<?php
			$sqlServiciosClientes =
				"SELECT Clientes.Nombre AS NombreCliente, Bicicletas.Modelo AS ModeloBicicleta, Servicios.Descripcion AS DescripcionServicio, Servicios.Fecha AS FechaServicio, Servicios.Precio AS PrecioServicio
				FROM Servicios
				INNER JOIN Bicicletas ON Servicios.ID_Bicicleta = Bicicletas.ID_Bicicleta
				INNER JOIN Clientes ON Bicicletas.ID_Cliente = Clientes.ID_Cliente";
			$resultServiciosClientes = $mysqli->query($sqlServiciosClientes);
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nombre del Cliente</th>
						<th>Modelo de la Bicicleta</th>
						<th>Descripción del Servicio</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = $resultServiciosClientes->fetch_assoc()): ?>
						<tr>
							<td><?= htmlspecialchars($row['NombreCliente']) ?></td>
							<td><?= htmlspecialchars($row['ModeloBicicleta']) ?></td>
							<td><?= htmlspecialchars($row['DescripcionServicio']) ?></td>
							<td><?= htmlspecialchars($row['FechaServicio']) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
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
