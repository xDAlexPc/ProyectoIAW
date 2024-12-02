<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaBike</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="images/iconoBici.jpeg" type="image/jpeg">
    
<style>
    body {
        background: url('images/fondo.jpg') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
    }
</style>

    
<style>
    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

</head>
<body>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ReparaBike - Nuevo Servicio</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Agregar Nuevo Servicio</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-container">
<form id="nuevoServicio" name="nuevoServicio" autocomplete="off" action="registrarServicios2.php" method="post">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Describe el servicio" required>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" name="precio" id="precio" class="form-control" placeholder="Introduce el precio del servicio" required>
                    </div>

                    <div class="form-group">
                        <label for="id_bicicleta">Seleccionar Bicicleta</label>
                        <select name="id_bicicleta" id="id_bicicleta" class="form-control">
                            <option value="">-- Selecciona una bicicleta --</option>
                            <?php
                            require 'conexion.php';
                            $sql = "SELECT id_bicicleta, Marca, Modelo FROM bicicletas WHERE ID_Cliente IS NOT NULL";
                            $resultado = $mysqli->query($sql);

                            if ($resultado && $resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option value='{$fila['id_bicicleta']}'>#{$fila['id_bicicleta']} - {$fila['Marca']} {$fila['Modelo']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Registrar Servicio" class="btn btn-primary">
                    </div>
                </form>
</div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>


</body>
</html>
