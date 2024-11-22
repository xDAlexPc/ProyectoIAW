<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ReparaBike - Opciones de Servicios</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Gestión de Servicios</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form id="opcionesServicios" name="opcionesServicios" autocomplete="off" method="post">
                    <div class="form-group">
                        <label for="opcion">¿Qué desea hacer?</label>
                        <select name="opcion" id="opcion" class="form-control" required>
                            <option value="">-- Selecciona una opción --</option>
                            <option value="nuevo_servicio">Añadir un nuevo servicio</option>
                            <option value="asociar_cliente">Asociar un cliente a un servicio</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Continuar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $opcion = $_POST['opcion'];
        
        if ($opcion == 'nuevo_servicio') {
            header("Location: registrarServicios.php");
            exit();
        } elseif ($opcion == 'asociar_cliente') {
            header("Location: asociarCliente.php");
            exit();
        }
    }
    ?>
</body>
</html>
