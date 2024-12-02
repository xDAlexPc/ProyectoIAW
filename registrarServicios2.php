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

    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $id_bicicleta = $_POST['id_bicicleta'];
    $id_bicicleta = !empty($_POST['id_bicicleta']) ? (int)$_POST['id_bicicleta'] : 'NULL';

    $sql = "INSERT INTO servicios (Descripcion, Precio, ID_Bicicleta, Fecha) 
            VALUES ('$descripcion', '$precio', $id_bicicleta, NOW())";

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
				<p><a href="registrarServicio.php" class="btn btn-primary">Regresar al resgistro</a></p>
				<p><a href="index.php" class="btn btn-primary">Regresar a la pagina principal</a></p>
		<?php		
			}
		?>
			<br>

</body>

</html>