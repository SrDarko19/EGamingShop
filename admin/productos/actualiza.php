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
    isset($_POST['precio']) && is_numeric($_POST['precio']) &&
    isset($_POST['descuento']) && is_numeric($_POST['descuento']) &&
    isset($_POST['stock']) && is_numeric($_POST['stock']) &&
    isset($_POST['categoria']) && is_numeric($_POST['categoria'])
) {
    $db = new Database();
    $con = $db->conectar();

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, descuento=?, stock=?, id_categoria=? WHERE id = ?";
    $stm = $con->prepare($sql);

    if ($stm->execute([$nombre, $descripcion, $precio, $descuento, $stock, $categoria, $id])) {

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

            foreach ($_FILES['otras_imagen']['tmp_name'] as $key => $tmp_name) {
                $fileName = $_FILES['otras_imagen']['name'][$key];
                $arregloImagen = explode('.', $fileName);
                $extension = strtolower(end($arregloImagen));

                $nuevoNombre = $dir . uniqid() . '.' . $extension;

                if (in_array($extension, $permitidos)) {
                    if (move_uploaded_file($tmp_name, $nuevoNombre)) {
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
