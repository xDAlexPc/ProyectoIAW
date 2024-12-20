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
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$dni = $_POST['dni'];
			
			require 'conexion.php';
			$sql = "INSERT INTO clientes (nombre,telefono,email,dni) VALUES ('$nombre','$telefono','$email','$dni')";

			$resultado = $mysqli->query($sql);

			if($resultado>0){
		?>
				<br>
				<p class="alert alert-primary">REGISTRO REALIZADO</p>
  				<br>
				<p><a href="index.php" class="btn btn-primary">Regresar</a></p>

		<?php
			} else {
		?>
				<br>
  				<p class="alert alert-danger">FALLO EN EL REGISTRO</p>
				<br>  
				<p><a href="registrar.php" class="btn btn-primary">Regresar al resgistro</a></p>
				<p><a href="index.php" class="btn btn-primary">Regresar a la pagina principal</a></p>
		<?php		
			}
		?>
			<br>
			
	</body>
</html>