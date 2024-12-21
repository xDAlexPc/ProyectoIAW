<?php
require 'conexion.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Bicicletas WHERE ID_Bicicleta = '$id'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bicicleta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Bicicleta</h1>
        <form action="editarBicicletas2.php" method="post">
            <input type="hidden" name="id" value="<?= $row['ID_Bicicleta'] ?>">
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?= $row['Marca'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $row['Modelo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $row['Tipo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" min="0" name="precio" value="<?= $row['Precio'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" min="0" name="stock" value="<?= $row['stock'] ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
