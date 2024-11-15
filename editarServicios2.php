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
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			require 'conexion.php';
			$sql = "UPDATE Servicios SET Descripcion = '$descripcion', Precio = '$precio' WHERE ID_Servicio = $id";
			$resultado = $mysqli->query($sql);
			if($resultado > 0){
		?>
				<br>
				<p class="alert alert-primary">SERVICIO MODIFICADO</p>
		<?php
			} else {
		?>
				<br>
  				<p class="alert alert-danger">SERVICIO NO MODIFICADO</p>
		<?php
			}
		?>
			<br>
			<p><a href="index.php" class="btn btn-primary">Regresar</a></p>
	</body>
</html>
