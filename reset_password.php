<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clientesFunciones.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($user_id == '' || $token == '') {
    header("Location: index.php");
    exit;
}

$db = new Database();
$con = $db->conectar();
$errors = [];

if (!verificaTokenRequest($user_id, $token, $con)) {
    echo "No se pudo verificar la información";
    exit;
} else {
    if (!empty($_POST)) {
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        if (esNulo([$password, $repassword])) {
            $errors[] = "Debe llenar todos los campos";
        } elseif (!validaPassword($password, $repassword)) {
            $errors[] = "Las contraseñas no coinciden";
        } else {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            if (actualizaPassword($user_id, $pass_hash, $con)) {
                echo "Contraseña modificada.<br><a href='login.php'>Iniciar sesión</a>";
                exit;
            } else {
                $errors[] = "Error al modificar contraseña. Inténtalo nuevamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E gaming Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 600px;
            padding: 40px;
            transform: translate(-50%, -50%);
            background: rgba(24, 20, 20, 0.987);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            border-radius: 10px;
        }

        .login-box .user-box {
            position: relative;
        }

        .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            pointer-events: none;
            transition: .5s;
        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: #bdb8b8;
            font-size: 12px;
        }

        .login-box form a {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px;
        }

        .login-box a:hover {
            background: #03f40f;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #03f40f,
                        0 0 25px #03f40f,
                        0 0 50px #03f40f,
                        0 0 100px #03f40f;
        }

        .login-box a span {
            position: absolute;
            display: block;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }

            50%, 100% {
                left: 100%;
            }
        }

        .login-box a span:nth-child(1) {
            bottom: 2px;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #03f40f);
            animation: btn-anim1 2s linear infinite;
        }

        .navbar, .container, .form-control {
            background: none;
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: #bdb8b8;
        }

        .text-center h1 {
            margin: 0;
            font-size: 24px;
            color: #fff;
        }

        .register-section {
            margin-top: 20px;
            text-align: center;
        }

        .register-section a {
            color: #03f40f;
            text-decoration: none;
        }

        .register-section a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand"><strong>Fusions Games</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                <a href="checkout.php" class="btn-cart">
                    <svg class="icon-cart" viewBox="0 0 24.38 30.52" height="30.52" width="24.38" xmlns="http://www.w3.org/2000/svg">
                        <title></title>
                        <path transform="translate(-3.62 -0.85)" d="M28,27.3,26.24,7.51a.75.75,0,0,0-.76-.69h-3.7a6,6,0,0,0-12,0H6.13a.76.76,0,0,0-.76.69L3.62,27.3v.07a4.29,4.29,0,0,0,4.52,4H23.48a4.29,4.29,0,0,0,4.52-4ZM15.81,2.37a4.47,4.47,0,0,1,4.46,4.45H11.35a4.47,4.47,0,0,1,4.46-4.45Zm7.67,27.48H8.13a2.79,2.79,0,0,1-3-2.45L6.83,8.34h3V11a.76.76,0,0,0,1.52,0V8.34h8.92V11a.76.76,0,0,0,1.52,0V8.34h3L26.48,27.4a2.79,2.79,0,0,1-3,2.44Zm0,0"></path>
                    </svg>
                    <span id="num_cart" class="quantity"><?php echo $num_cart; ?></span>
                </a>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container login-box">
        <h2 class="text-center text-white">Cambiar Contraseña</h2>

        <?php mostrarMensajes($errors); ?>

        <form action="reset_password.php" method="post" autocomplete="off">
            <input type="hidden" name="user_id" id="user_id" value="<?=$user_id;?>"/>
            <input type="hidden" name="token" id="token" value="<?=$token;?>"/>

            <div class="user-box">
                <input type="password" name="password" id="password" required>
                <label for="password">Nueva Contraseña</label>
            </div>

            <div class="user-box">
                <input type="password" name="repassword" id="repassword" required>
                <label for="repassword">Confirmar Contraseña</label>
            </div>

            <center>
                <a href="#" onclick="document.querySelector('form').submit();">
                    Continuar
                    <span></span>
                </a>
            </center>

            <div class="register-section">
                        <a href="login.php">Inicia Sesión aquí</a>
                    </div>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
