<?php 

$path = dirname(__FILE__);

require_once $path . '/database.php';
require_once $path . '/../admin/clases/cifrado.php';
//se le cambio el nombre a la variable datos de la conexion a datosConfigs por seguridad
$db = new Database();
$con = $db->conectar();
$sql = "SELECT nombre, valor FROM configuracion";
$resultado = $con->query($sql);
$datosConfigs = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];
foreach ($datosConfigs as $dato) {
$config[$dato['nombre']] = $dato['valor'];
 }

define("SITE_URL", "http://localhost/Proyecto/EGamingShop");
define("CLIENT_ID", "AaIQ9y97v3FnEfn0l3a8epKZSi0M-nPXnxe3wcVBSxLPuZHKMFmug48fsfMw-2qn52VQYOp32TFwpGwo");
define("CURRENCY", "USD");
define("KEY_TOKKEN", "221133");

define("Moneda", "$");

//ENVIO DE CORREO
define( "MAIL_HOST", $config['correo_smtp']);
define ("MAIL_USER", $config['correo_email']);
define ("MAIL_PASS" ,descifrar($config['correo_password']));
define ("MAIL_PORT", $config['correo_puerto']);

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>
