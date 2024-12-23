<?php
require 'conexion.php';
$sql = "SELECT ID_Bicicleta, Marca, Modelo, Tipo, Precio, stock 
        FROM Bicicletas 
        WHERE ID_Cliente IS NULL OR stock > 1";
$resultado = $mysqli->query($sql);
?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<link rel="icon" type="image/jpeg" href="images/iconoBici.jpeg">
	<title>ReparaBike</title>
	<script>
		$(document).ready(function() {
			$('#tabla').DataTable();
		});
	</script>

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<h1>ReparaBike</h1>
		</div>
		<br>
		<div class="container mt-5">
			<div class="titulo_tabla">
				<h2>Bicicletas en Venta</h2>
				<a href="registrarBicicleta.php" class="btn btn-primary boton">Añadir</a>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Tipo</th>
						<th>Stock</th>
						<th>Precio</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = $resultado->fetch_assoc()): ?>
						<tr>
							<td><?= htmlspecialchars($row['Marca']) ?></td>
							<td><?= htmlspecialchars($row['Modelo']) ?></td>
							<td><?= htmlspecialchars($row['Tipo']) ?></td>
							<td><?= htmlspecialchars($row['stock']) ?></td>
							<td><?= htmlspecialchars($row['Precio']) ?></td>
							<td><a href="editarBicicletas.php?id=<?= $row['ID_Bicicleta'] ?>" class="btn btn-primary">Editar</a> 
                                <a href="eliminarBicicletas.php?id=<?= $row['ID_Bicicleta'] ?>" class="btn btn-danger">Eliminar</a></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

		<br>
		<br>

		<div class="container">
			<div class="titulo_tabla">
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

		<div class="container">
			<div class="titulo_tabla">
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


		<div class="container">
			<div class="titulo_tabla">
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

		<div class="container">
			<div class="titulo_tabla">
				<h2>Operaciones</h2>
				<a href="registrarOperacion.php" class="btn btn-primary boton">Añadir</a>
			</div>
			<?php
			$sqloperaciones =
				"SELECT Clientes.Nombre AS NombreCliente, Bicicletas.Modelo AS ModeloBicicleta, Operaciones.Tipo AS TipoOperacion, Operaciones.Fecha AS FechaOperacion, Operaciones.Coste AS CosteOperacion, Operaciones.Cantidad AS CantidadOperacion
				FROM Operaciones
				INNER JOIN Bicicletas ON Operaciones.ID_Bicicleta = Bicicletas.ID_Bicicleta
				INNER JOIN Clientes ON Operaciones.ID_Cliente = Clientes.ID_Cliente";
			$resultoperaciones = $mysqli->query($sqloperaciones);
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Operacion</th>
						<th>Cliente</th>
						<th>Bicicleta</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = $resultoperaciones->fetch_assoc()): ?>
						<tr>
							<td><?= htmlspecialchars($row['TipoOperacion']) ?></td>
							<td><?= htmlspecialchars($row['NombreCliente']) ?></td>
							<td><?= htmlspecialchars($row['ModeloBicicleta']) ?></td>
							<td><?= htmlspecialchars($row['CantidadOperacion']) ?></td>
							<td><?= htmlspecialchars($row['CosteOperacion']) ?></td>
							<td><?= htmlspecialchars($row['FechaOperacion']) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

	</div>
</body>

</html>