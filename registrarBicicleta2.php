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

require 'conexion.php';

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$id_cliente = !empty($_POST['id_cliente']) ? intval($_POST['id_cliente']) : NULL;

$sql = "INSERT INTO bicicletas (Marca, Modelo, Tipo, Precio, stock, ID_Cliente) 
        VALUES ('$marca', '$modelo', '$tipo', $precio, $stock, " . ($id_cliente ? $id_cliente : "NULL") . ")";



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