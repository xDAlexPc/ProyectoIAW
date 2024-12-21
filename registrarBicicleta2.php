<?php
require 'conexion.php';

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

$sql = "INSERT INTO Bicicletas (Marca, Modelo, Tipo, Precio, Stock) VALUES ('$marca', '$modelo', '$tipo', '$precio', '$stock')";
$resultado = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Bicicleta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if ($resultado): ?>
            <div class="alert alert-success text-center mt-3">Registro completado con éxito.</div>
        <?php else: ?>
            <div class="alert alert-danger text-center mt-3">No se pudo completar el registro.</div>
        <?php endif; ?>
        <div class="text-center mt-3">
            <a href="bicicletas.php" class="btn btn-primary">Regresar</a>
        </div>
    </div>
</body>
</html>
