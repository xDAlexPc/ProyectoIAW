<?php
    $id = $_GET['id'];

    require 'conexion.php';

    $sql = "SELECT * FROM Servicios WHERE ID_Servicio = $id";
    $resultado = $mysqli->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "Servicio no encontrado.";
        exit;
    }
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
                <h1>Editar Servicio</h1>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form id="editarServicio" name="editarServicio" autocomplete="off" action="editarServicios2.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Introduce la descripción del servicio" value="<?php echo htmlspecialchars($fila['Descripcion']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" name="precio" id="precio" class="form-control" placeholder="Introduce el precio" value="<?php echo htmlspecialchars($fila['Precio']); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Actualizar Servicio" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
