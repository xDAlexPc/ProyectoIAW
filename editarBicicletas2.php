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
			$marca = $_POST['marca'];
			$modelo = $_POST['modelo'];
			$tipo = $_POST['tipo'];
			$precio = $_POST['precio'];
			$stock = $_POST['stock'];
			require 'conexion.php';
			$sql = "UPDATE bicicletas SET Marca='$marca', Modelo='$modelo', Tipo='$tipo', Precio='$precio', stock='$stock' WHERE ID_Bicicleta=$id";
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
