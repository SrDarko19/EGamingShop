<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clientesFunciones.php';

$db = new Database();
$con = $db->conectar();

$idCliente = $_SESSION['user_cliente']; 

$sql = $con->prepare("SELECT id_transaccion, fecha, status, total, medio_pago FROM compra WHERE id_cliente = ? ORDER BY DATE(fecha) DESC");
$sql->execute([$idCliente]);

// Verificar si hay resultados
if ($sql->rowCount() > 0) { 
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fusion Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">

</head>
<body>
        <?php include 'menu.php'; ?>

        <main>
            <div class="container">
                <h4>Mis compras</h4>
                <hr>

                <?php while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="card mb-3 bg-success"> 
                        <div class="card-header">
                            <?php echo $row['fecha']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Folio: <?php echo $row['id_transaccion']; ?></h5>
                            <p class="card-text">Total: <?php echo $row['total']; ?></p>
                            <a href="compra_detalle.php?id_transaccion=<?= $row['id_transaccion']; ?>" class="btn btn-primary">Ver Compra</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>



    <?php
} else {
    echo "No se encontraron compras.";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>
