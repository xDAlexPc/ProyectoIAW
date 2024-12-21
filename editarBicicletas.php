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

<?php
    $id = $_GET['id'];
    require 'conexion.php';
    $sql = "SELECT * FROM bicicletas WHERE id_bicicleta = $id";
    $resultado = $mysqli->query($sql);
    $fila = $resultado->fetch_assoc();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ReparaBike - Editar Bicicleta</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Editar Bicicleta</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-container">
<form id="editarBicicleta" name="editarBicicleta" autocomplete="off" action="editarBicicletas2.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control" placeholder="Introduce la marca" value="<?php echo $fila['Marca']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Introduce el modelo" value="<?php echo $fila['Modelo']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Ej. Montaña, Carretera" value="<?php echo $fila['Tipo']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" name="precio" id="precio" min="0" class="form-control" placeholder="Introduce el precio" value="<?php echo $fila['Precio']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" min="0" class="form-control" placeholder="Introduce la cantidad en stock" value="<?php echo $fila['stock']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Editar" class="btn btn-primary">
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
