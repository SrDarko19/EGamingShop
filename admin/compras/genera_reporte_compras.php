<?php
require_once '../config/config.php';

session_start(); // Agregar inicio de sesión si no está presente

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../index.php');
    exit;
}



require_once '../header.php';
?>
<main>
    <div class="container">
        <h4>Reporte de compras</h4>

        <form action="reportes_compras.php" method="post" autocomplete="off">
            <div class="row mb-2">
                <div class="col-12 col-md-4">
                 <label for="fecha ini">Fecha inicial</label>
                 <input type="date" name="fecha_ini" id="fecha_ini" required>
                </div>
                <div class="col-12 col-md-4" >
                            <label for="fecha_fin" class="form-label">Fecha final:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" required>
                            </div>
            </div>
                <button type="submit" class="btn btn-primary">Generar</button>

        </form>

        <hr>
        
    </div>
</main>




<?php include '../footer.php'; ?>
