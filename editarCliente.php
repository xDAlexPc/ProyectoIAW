<?php
	$id=$_GET['id'];
	require 'conexion.php';
	$sql = "SELECT * FROM clientes WHERE id_cliente=$id";
	$resultado = $mysqli->query($sql);
	$fila = $resultado->fetch_assoc();
?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>ReparaBike</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1>Editar cliente</h1>
			</div>
			<div class="row">
				<div class="col-md-8">
					<form id="registro" name="registro" autocomplete="off" action="editarCliente2.php" method="post">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Introduce el nombre" value="<?php echo $fila['Nombre']; ?>" required>
						</div>

						<div class="form-group">
							<label for="telefono">Teléfono</label>
							<input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Introduce el teléfono" value="<?php echo $fila['Telefono']; ?>" required>
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" class="form-control" value="<?php echo $fila['Email']; ?>" required>
						</div>
						
						<div class="form-group">
							<label for="contraseña">Contraseña</label>
							<input type="password" name="contraseña" id="contraseña" class="form-control" value="<?php echo $fila['Contraseña']; ?>" required>
						</div>
						
						<div class="form-group">
							<input type="submit" value="Editar" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery-3.4.1.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
	</body>
</html>				