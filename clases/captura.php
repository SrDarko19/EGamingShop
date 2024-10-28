<?php 

require_once '../config/config.php';
require_once '../config/database.php';
session_start();

$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (is_array($datos)) {
    $id_cliente = $_SESSION['user_cliente'];
    $sql = $con->prepare("SELECT email FROM clientes WHERE id=? AND estatus=1");
    $sql->execute([$id_cliente]);
    $row_cliente = $sql->fetch(PDO::FETCH_ASSOC);

    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $row_cliente['email'];

    $sql = $con->prepare("INSERT INTO compra (id_transaccion, fecha, status, email, id_cliente, total) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->execute([$id_transaccion, $fecha_nueva, $status, $email, $id_cliente, $total]);
    $id = $con->lastInsertId();

    if ($id > 0) {
        $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

        if ($productos != null) {
            $cuerpo = '<h4>Gracias por su compra</h4>';
            $cuerpo .= '<p>El ID de su compra es: <b>' . $id_transaccion . '</b></p>';
            $cuerpo .= '<p>Detalles de los productos adquiridos:</p><ul>';

            foreach ($productos as $clave => $cantidad) {
                $sql = $con->prepare("SELECT id, nombre, precio, descuento, Llave FROM productos WHERE id=? AND activo=1");
                $sql->execute([$clave]);
                $row_prod = $sql->fetch(PDO::FETCH_ASSOC);

                $precio = $row_prod['precio'];
                $descuento = $row_prod['descuento'];
                $precio_desc = $precio - (($precio * $descuento) / 100);

                $sql_insert = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, precio, cantidad) 
                                            VALUES (?, ?, ?, ?, ?)");
                if ($sql_insert->execute([$id, $clave, $row_prod['nombre'], $precio_desc, $cantidad])) {
                    restarStock($clave, $cantidad, $con);
                }

                // Agregar información de producto y llave en el correo
                $cuerpo .= '<li><b>Producto:</b> ' . $row_prod['nombre'] . '<br>';
                $cuerpo .= '<b>Precio:</b> $' . number_format($precio_desc, 2) . '<br>';
                $cuerpo .= '<b>Cantidad:</b> ' . $cantidad . '<br>';
                $cuerpo .= '<b>Llave canjeable en steam:</b> ' . $row_prod['Llave'] . '</li><br>';
            }

            $cuerpo .= '</ul>';
            $cuerpo .= '<p>Total de la compra: <b>$' . number_format($total, 2) . '</b></p>';

            require_once 'Mailer.php';
            $asunto = "Detalle de compra";

            $mailer = new Mailer();
            $mailer->enviarEmail($email, $asunto, $cuerpo);
        }

        unset($_SESSION['carrito']);
    }
}

function restarStock($id, $cantidad, $con) {
    $sql = $con->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
    $sql->execute([$cantidad, $id]);
}
