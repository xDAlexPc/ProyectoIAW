<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<title>ReparaBike</title>
	</head>
	<body>
		<?php
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$contraseña = $_POST['contraseña'];
			require 'conexion.php';
			$sql = "UPDATE clientes SET Nombre='$nombre', Telefono='$telefono', Email='$email', Contraseña='$contraseña' WHERE ID_Cliente=$id";
			$resultado = $mysqli->query($sql);

			if($resultado>0){
		?>
				<br>
				<p class="alert alert-primary">REGISTRO MODIFICADO</p>
		<?php
			} else {
		?>
				<br>
  				<p class="alert alert-danger">REGISTRO NO MODIFICADO</p>
		<?php
			}
		?>
			<br>
			<p><a href="index.php" class="btn btn-primary">Regresar</a></p>
	</body>
</html>

