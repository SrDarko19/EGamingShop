<?php 
require_once '../config/config.php';

// Codigo modificado inicio
$datos['ok'] = false;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 1; 
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKKEN);

    if ($token == $token_tmp && $cantidad > 0 && is_numeric($cantidad)) {
        // Inicializar el carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = ['productos' => []];
        }

        // Verificar si el producto ya está en el carrito
        if (!isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = 0;
        }

        // Obtener la cantidad actual del producto en el carrito
        $cantidad += $_SESSION['carrito']['productos'][$id];

        $db = new Database();
        $con = $db->conectar();
        $sql = $con->prepare("SELECT stock FROM productos WHERE id=? AND activo=1 LIMIT 1");
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $stock = $row['stock'];

        if ($stock >= $cantidad) {
            $datos['ok'] = true;
            $_SESSION['carrito']['productos'][$id] = $cantidad; // Actualizar la cantidad del producto en el carrito
            $datos['numero'] = count($_SESSION['carrito']['productos']);
        }
    }
}

echo json_encode($datos);
?>