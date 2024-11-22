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
				<h1>Nueva Bicicleta</h1>
			</div>
			
			<div class="row">
				<div class="col-md-8">
					<form action="registrarBicicleta2.php" id="registro" name="registro" autocomplete="off" method="post">
						<div class="form-group">
							<label for="marca">Marca</label>
							<input type="text" name="marca" id="marca" class="form-control" placeholder="Introduce la marca de la bicicleta" required>
						</div>
						
						<div class="form-group">
							<label for="modelo">Modelo</label>
							<input type="text" name="modelo" id="modelo" class="form-control" placeholder="Introduce el modelo de la bicicleta" required>
						</div>
						
						<div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="">-- Selecciona el tipo de bicicleta --</option>
                                <option value="Montaña">Montaña</option>
                                <option value="Carretera">Carretera</option>
                            </select>
						</div>
						
						<div class="form-group">
							<label for="precio">Precio</label>
							<input type="number" name="precio" id="precio" class="form-control" placeholder="Introduce el precio de la bicicleta" required>
						</div>

                        <div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" name="stock" id="stock" class="form-control" placeholder="Introduce la cantidad de bicicletas" required>
						</div>
						
                        <div class="form-group">
                            <label for="id_cliente">Seleccionar Cliente</label>
                            <select name="id_cliente" id="id_cliente" class="form-control">
                                <option value="">-- Sin dueño --</option>
                                <?php
                                    require 'conexion.php';
                                    $sql = "SELECT id_cliente, Nombre FROM clientes";
                                    $resultado = $mysqli->query($sql);

                                    if ($resultado && $resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {
                                            echo "<option value='{$fila['id_cliente']}'>{$fila['Nombre']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>

						<div class="form-group">
							<input type="submit" value="Registrar" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="js/jquery-3.4.1.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
	</body>
</html>
