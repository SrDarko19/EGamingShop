<?php
require_once '../config/database.php';
require_once '../config/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

if (
    isset($_POST['nombre']) && !empty($_POST['nombre']) &&
    isset($_POST['descripcion']) && !empty($_POST['descripcion']) &&
    isset($_POST['llave']) && !empty($_POST['llave']) && // Captura de llave de Steam
    isset($_POST['precio']) && is_numeric($_POST['precio']) &&
    isset($_POST['descuento']) && is_numeric($_POST['descuento']) &&
    isset($_POST['stock']) && is_numeric($_POST['stock']) &&
    isset($_POST['categoria']) && is_numeric($_POST['categoria'])
) {
    $db = new Database();
    $con = $db->conectar();

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $llave = $_POST['llave']; // Captura de llave de Steam
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    // Modificar la consulta SQL para incluir la llave de Steam
    $sql = "INSERT INTO productos (nombre, descripcion, llave, precio, descuento, stock, id_categoria, activo) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
    $stm = $con->prepare($sql);

    if ($stm->execute([$nombre, $descripcion, $llave, $precio, $descuento, $stock, $categoria])) { // Agregar $llave a la ejecución
        $id = $con->lastInsertId();

        // Subir imagen principal
        if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK) {
            $dir = '../../images/productos/' . $id . '/';
            $permitidos = ['jpeg', 'jpg'];
            
            $arregloImagen = explode('.', $_FILES['imagen_principal']['name']);
            $extension = strtolower(end($arregloImagen));

            if (in_array($extension, $permitidos)) {
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $ruta_img = $dir . 'juego.' . $extension;
                if (move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $ruta_img)) {
                    echo "La imagen principal se cargó correctamente.";
                } else {
                    echo "Hubo un error al cargar la imagen principal.";
                }
            } else {
                echo "La extensión de la imagen principal no es válida.";
            }
        }

        // Subir otras imágenes
        if (isset($_FILES['otras_imagen'])) {
            $permitidos = ['jpeg', 'jpg'];
            $dir = '../../images/productos/' . $id . '/';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $contador = 1;
            foreach ($_FILES['otras_imagen']['tmp_name'] as $key => $tmp_name) {
                $fileName = $_FILES['otras_imagen']['name'][$key];
                $arregloImagen = explode('.', $fileName);
                $extension = strtolower(end($arregloImagen));

                if (in_array($extension, $permitidos)) {
                    $ruta_img = $dir . $contador . '.' . $extension;
                    if (move_uploaded_file($tmp_name, $ruta_img)) {
                        echo "La imagen $contador se cargó correctamente. <br>";
                    } else {
                        echo "Hubo un error al cargar la imagen $contador.";
                    }
                } else {
                    echo "La extensión de la imagen $contador no es válida.";
                }
                $contador++;
            }
        }
    } else {
        echo "Hubo un error al insertar el registro en la base de datos.";
    }
} else {
    echo "Todos los campos son obligatorios y deben tener valores válidos.";
}

header('Location: index.php');
exit;
?>
