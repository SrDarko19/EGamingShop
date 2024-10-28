<?php

require 'config/database.php';
require 'config/config.php';
require 'clases/adminFunciones.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
header ('Location: index.php');
exit;
}

$user_id = $_GET['id'] ?? $_POST['id'] ?? '';

if ($user_id == '' || $user_id != $_SESSION['user_id']) {
header("Location: index.php");
exit;
}

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
$password = trim($_POST['password']);
$repassword = trim($_POST['repassword']);

if (esNulo([$user_id, $password, $repassword])) {
$errors [] = "Debe llenar todos los campos";
}

if (!validaPassword($password, $repassword)) { 
    $errors [] = "Las contraseñas no coinciden";
}

if (empty($errors) ) {
$pass_hash = password_hash($password, PASSWORD_DEFAULT);
if (actualizaPasswordAdmin($user_id, $pass_hash, $con)) {
$errors [] = "Contraseña modificada.";
} else {
$errors [] = "Error al modificar contraseña. Intenta nuevamente.";
}
}
}

$sql = "SELECT id, usuario FROM admin WHERE id = ?";
$sql = $con->prepare($sql);
$sql->execute([$user_id]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

require 'header.php';
?>
<!-- Contenido -->
<main class="form-login m-auto">
<h3>Cambiar contraseña</h3>

<?php mostrarMensajes ($errors); ?>

<form class="row g-3" action="cambiar_contraseña.php" method="post" autocomplete="off">

<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

<div class="form-floating">
<input type="text" class="form-control" id="usuario" value="<?php echo $usuario['usuario']; ?>" disabled>
<label for="usuario">Usuario</label>
</div>

<div class="form-floating">
<input type="password" class="form-control" id="password"name="password" placeholder="Nueva contraseña" required autofocus>
<label for="password">Nueva contraseña</label >
</div>

<div class="form-floating">
<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirmar contraseña" required>
<label for="repassword" >Confirmar contraseña</label>
</div>

<div class="d-grid gap-3 col-12">
<button type="submit" class="bth btn-primary">Actualizar</button>
</div>
</form>
</main>

<?php include 'footer.php'; ?>