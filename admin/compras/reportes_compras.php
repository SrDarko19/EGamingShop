<?php
require_once '../config/database.php';
require_once '../config/config.php';
require_once('../fpdf/plantilla.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$fechaIni = $_POST['fecha_ini'] ?? '2024-04-01'; // Cambiar a '2024-04-01' para evitar errores de 'undefined index
$fechaFin = $_POST['fecha_fin'] ?? '2024-10-01';

$query = "SELECT date_format(c.fecha, '%d/%m/%Y %H:%i') AS fechaHora, c.status, c.total, c.medio_pago, CONCAT(cli.nombres,' ',cli.apellidos) AS cliente
FROM compra AS c
INNER JOIN clientes AS cli ON c.id_cliente = cli.id
WHERE DATE(c.fecha) BETWEEN ? AND ?
ORDER BY DATE(fecha) ASC";

$resultado = $con->prepare($query);
$resultado->execute([$fechaIni, $fechaFin]);

$datos = [
    'fechaIni' => $fechaIni,
    'fechaFin' => $fechaFin,
    ];

$pdf = new PDF('P','mm','Letter', $datos);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(30, 6, $row['fechaHora'], 1, 0);
    $pdf->Cell(30, 6, $row['status'], 1, 0);
    $pdf->Cell(60, 6, $row['cliente'], 1, 0);
    $pdf->Cell(30, 6, $row['total'], 1, 1);
}
$pdf->Output('D', 'Reporte de compras.pdf');
?>
