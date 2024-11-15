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
			$id = $_GET['id'];
			require 'conexion.php';
			$sql = "DELETE FROM bicicletas WHERE ID_Bicicleta=$id";
			$resultado = $mysqli->query($sql);

			if($resultado>0){
		?>
				<br>
				<p class="alert alert-primary">REGISTRO ELIMINADO</p>
		<?php
			} else {
		?>
				<br>
				<p class="alert alert-danger">REGISTRO NO ELIMINADO</p>
		<?php
			}
		?>
			<br>
			<p><a href="index.php" class="btn btn-primary">Regresar</a></p>

	</body>
</html>