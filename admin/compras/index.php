<?php
require_once '../config/config.php';
require_once '../config/database.php';
 // Agregar inicio de sesión si no está presente

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$sql = "SELECT compra.id_transaccion, compra.fecha, compra.status, compra.total, compra.medio_pago, CONCAT(clientes.nombres,' ' ,clientes.apellidos) AS cliente
        FROM compra
        INNER JOIN clientes ON compra.id_cliente = clientes.id
        ORDER BY compra.fecha DESC"; // Ordenar por fecha DESC para ver las compras más recientes primero
$resultado = $con->query($sql);

require_once '../header.php';
?>
<main>
    <div class="container">
        <h4>Compras</h4>

        <a href="genera_reporte_compras.php" class="btn btn-success btn-sm">
        Reporte de compras
        </a>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $row['id_transaccion']; ?></td>
                        <td><?php echo $row['cliente']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detalleModal" data-bs-orden="<?php echo $row['id_transaccion']; ?>">
                                Ver
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detalleModalLabel">Detalles de compra</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se cargarán los detalles de la compra -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
const detalleModal = document.getElementById('detalleModal');
detalleModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const orden = button.getAttribute('data-bs-orden');
    const modalBody = detalleModal.querySelector('.modal-body');

    const url = '<?php echo ADMIN_URL; ?>compras/getCompra.php';
    let formData = new FormData();
    formData.append('orden', orden);

    fetch(url, { 
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        modalBody.innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
        modalBody.innerHTML = '<p>Ocurrió un error al obtener los detalles de la compra.</p>';
    });
});

detalleModal.addEventListener('hide.bs.modal', event => {
    const modalBody = detalleModal.querySelector('.modal-body');
    modalBody.innerHTML = ''
})
</script>

<?php include '../footer.php'; ?>
