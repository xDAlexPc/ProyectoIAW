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
    <title>ReparaBike - Clientes</title>
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
				<h2>Clientes</h2>
				<a href="registrar.php" class="btn btn-primary boton">Añadir</a>
			</div>
			<?php
			$sqlClientes = "SELECT ID_Cliente, Nombre, Telefono, Email, DNI FROM Clientes";
			$resultClientes = $mysqli->query($sqlClientes);
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Teléfono</th>
						<th>Email</th>
						<th>DNI</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = $resultClientes->fetch_assoc()): ?>
						<tr>
							<td><?= htmlspecialchars($row['Nombre']) ?></td>
							<td><?= htmlspecialchars($row['Telefono']) ?></td>
							<td><?= htmlspecialchars($row['Email']) ?></td>
							<td><?= htmlspecialchars($row['DNI']) ?></td>
							<td><a href="editarCliente.php?id=<?= $row['ID_Cliente'] ?>" class="btn btn-primary">Editar</a> <a href="eliminarCliente.php?id=<?= $row['ID_Cliente'] ?>" class="btn btn-danger">Eliminar</a></td>
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
