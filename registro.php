<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clientesFunciones.php';
require_once 'clases/Mailer.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $usuario = trim($_POST['usuario']);
    $Dui = trim($_POST['Dui']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$nombres, $apellidos, $email, $telefono, $usuario, $Dui, $password, $repassword])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(!esEmail($email)){
        $errors[] ="La direccion de correo no es valida";
    }

    if(!validaPassword($password, $repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }

    if(usuarioExiste($usuario, $con)){
        $errors[] = "El nombre de usuario $usuario ya existe";
    }

    if(emailExiste($email, $con)){
        $errors[] = "El correo electronico $email ya existe";
    }

    if(DuiExiste($Dui, $con)){
        $errors[] = "El Dui $Dui ya existe";
    }
    
    if (count($errors) == 0) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $token = generarToken();
    
        $id = registrarCliente([$nombres, $apellidos, $email, $telefono, $Dui], $con);
    
        if ($id > 0) { 
            $idusuario = registraUsurario([$usuario, $pass_hash, $token, $id], $con);
            if ($idusuario > 0) {


                $url = SITE_URL . '/activa_cliente.php?id=' . $idusuario . '&token=' . $token;
                $asunto = 'Activación de cuenta';
                $cuerpo = "Estimado $nombres: <br> Para continuar con el proceso de registro es indispensable dar click en la siguiente liga: <a href='$url'>Activar cuenta</a>";
                $mailer = new MAiler(); // Crea una instancia de tu clase Mailer
    
                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado a la dirección de correo electrónico: $email";
                    exit;
                } else {
                    // Manejo de errores de tu clase Mailer
                    $errors[] = "Error al enviar el correo de activación"; // O muestra el error específico de tu clase Mailer si lo tienes
                }
            } else {
                $errors[] = 'Error al registrar el usuario';
            }
        } else {
            $errors[] = 'Error al registrar el cliente';
        }
    }
/*    if (count($error) == 0) {
        // Success
    } else {
        print_r($error);
    } */
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
            width: 600px; /* Adjusted width */
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
        .btn {
  --border-color: linear-gradient(-45deg, #ffae00, #7e03aa, #00fffb);
  --border-width: 0.125em;
  --curve-size: 0.5em;
  --blur: 30px;
  --bg: #080312;
  --color: #afffff;
  color: var(--color);
  cursor: pointer;
  /* use position: relative; so that BG is only for .btn */
  position: relative;
  isolation: isolate;
  display: inline-grid;
  place-content: center;
  padding: 0.5em 1.5em;
  font-size: 17px;
  border: 0;
  text-transform: uppercase;
  box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.6);
  clip-path: polygon(
    /* Top-left */ 0% var(--curve-size),
    var(--curve-size) 0,
    /* top-right */ 100% 0,
    100% calc(100% - var(--curve-size)),
    /* bottom-right 1 */ calc(100% - var(--curve-size)) 100%,
    /* bottom-right 2 */ 0 100%
  );
  transition: color 250ms;
}

.btn::after,
.btn::before {
  content: "";
  position: absolute;
  inset: 0;
}

.btn::before {
  background: var(--border-color);
  background-size: 300% 300%;
  animation: move-bg7234 5s ease infinite;
  z-index: -2;
}

@keyframes move-bg7234 {
  0% {
    background-position: 31% 0%;
  }

  50% {
    background-position: 70% 100%;
  }

  100% {
    background-position: 31% 0%;
  }
}

.btn::after {
  background: var(--bg);
  z-index: -1;
  clip-path: polygon(
    /* Top-left */ var(--border-width)
      calc(var(--curve-size) + var(--border-width) * 0.5),
    calc(var(--curve-size) + var(--border-width) * 0.5) var(--border-width),
    /* top-right */ calc(100% - var(--border-width)) var(--border-width),
    calc(100% - var(--border-width))
      calc(100% - calc(var(--curve-size) + var(--border-width) * 0.5)),
    /* bottom-right 1 */
      calc(100% - calc(var(--curve-size) + var(--border-width) * 0.5))
      calc(100% - var(--border-width)),
    /* bottom-right 2 */ var(--border-width) calc(100% - var(--border-width))
  );
  transition: clip-path 500ms;
}

.btn:where(:hover, :focus)::after {
  clip-path: polygon(
    /* Top-left */ calc(100% - var(--border-width))
      calc(100% - calc(var(--curve-size) + var(--border-width) * 0.5)),
    calc(100% - var(--border-width)) var(--border-width),
    /* top-right */ calc(100% - var(--border-width)) var(--border-width),
    calc(100% - var(--border-width))
      calc(100% - calc(var(--curve-size) + var(--border-width) * 0.5)),
    /* bottom-right 1 */
      calc(100% - calc(var(--curve-size) + var(--border-width) * 0.5))
      calc(100% - var(--border-width)),
    /* bottom-right 2 */
      calc(100% - calc(var(--curve-size) + var(--border-width) * 0.5))
      calc(100% - var(--border-width))
  );
  transition: 200ms;
}

.btn:where(:hover, :focus) {
  color: #fff;
}

/* Estilos personalizados */
            /* Estilos personalizados */
            .navbar {
            background-color: #343a40; /* Color de fondo */
            padding: 10px 20px; /* Espaciado */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            font-size: 1.1rem;
            margin-right: 15px;
        }

        .btn-cart {
            position: relative;
            margin-left: 15px;
            margin-right: 20px; /* Añadir espacio a la derecha del carrito */
        }

        .icon-cart {
            fill: #ffffff;
        }

        .quantity {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.8rem;
        }

        .dropdown-menu {
            background-color: #343a40;
        }

        .dropdown-menu .dropdown-item {
            color: #ffffff;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #495057;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .fas {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand"><strong>Fusion games</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " href="index.php">Catálogo</a>
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
        <?php if(isset($_SESSION['user_id'])) { ?>
                    <div class="dropdown">
                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="compras.php">Mis Compras</a></li>
                            <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <a href="login.php" class="btn btn-success btn-sm"><i class="fas fa-user"></i> Ingresar</a>
                <?php } ?>
    </div>
</header> 
<main>
    <div class="container login-box">
        <h2 class="text-center text-white">Datos del cliente</h2>
            <br>
            <br>
        <?php mostrarMensajes($errors); ?>


        <form class="row g-3" action="registro.php" method="post" autocomplete="off">
            <div class="user-box col-md-6">
                <input type="text" name="nombres" id="nombres" requireda>
                <label for="nombres">Nombres</label>
            </div>
            <div class="user-box col-md-6">
                <input type="text" name="apellidos" id="apellidos" requireda>
                <label for="apellidos">Apellidos</label>
            </div>
            <div class="user-box col-md-6">
                <input type="email" name="email" id="email" requireda>
                <label for="email">Email</label>
                <span id="validaEmail" class="text-danger"></span>
            </div>
            <div class="user-box col-md-6">
                <input type="tel" name="telefono" id="telefono" requireda>
                <label for="telefono">Teléfono</label>
            </div>
            <div class="user-box col-md-6">
                <input type="text" name="usuario" id="usuario" requireda>
                <label for="usuario">Usuario</label>
                <span id="validaUsuario" class="text-danger"></span>
            </div>
            <div class="user-box col-md-6">
                <input type="text" name="Dui" id="Dui" requireda>
                <label for="Dui">Dui</label>
                <span id="validaDui" class="text-danger"></span>
            </div>
            <div class="user-box col-md-6">
                <input type="password" name="password" id="password" requireda>
                <label for="password">Contraseña</label>
            </div>
            <div class="user-box col-md-6">
                <input type="password" name="repassword" id="repassword" requireda>
                <label for="repassword">Confirmar contraseña</label>
            </div>
            <div class="col-12 text-white">
                <i><b>Nota:</b> Los Campos con asterisco son obligatorios</i>
            </div>
            <center>
                <a href="#" onclick="document.querySelector('form').submit();">
                    SEND
                    <span></span>
                </a>
            </center>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    let txtUsuario = document.getElementById('usuario')
    txtUsuario.addEventListener("blur", function(){
        existeUsuario(txtUsuario.value)
    }, false)

    let txtEmail = document.getElementById('email')
    txtEmail.addEventListener("blur", function(){
        existeEmail(txtEmail.value)
    }, false)

    let txtDui = document.getElementById('Dui')
    txtDui.addEventListener("blur", function(){
        existeDui(txtDui.value)
    }, false)

    function existeUsuario(usuario){

        let url = "clases/clienteAjax.php";
        let formData = new FormData()
        formData.append("action", "existeUsuario")
        formData.append("usuario", usuario)

        fetch(url, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {

            if(data.ok){
                document.getElementById('usuario').value = ''
                document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
            } else {
                document.getElementById('validaUsuario').innerHTML = ''
            }

        })
    }

    function existeEmail(email){

let url = "clases/clienteAjax.php";
let formData = new FormData()
formData.append("action", "existeEmail")
formData.append("email", email)

fetch(url, {
    method: 'POST',
    body: formData
}).then(response => response.json())
.then(data => {

    if(data.ok){
        document.getElementById('email').value = ''
        document.getElementById('validaEmail').innerHTML = 'Email no disponible'
    } else {
        document.getElementById('validaEmail').innerHTML = ''
    }

    })
}

function existeDui(Dui){

let url = "clases/clienteAjax.php";
let formData = new FormData()
formData.append("action", "existeDui")
formData.append("Dui", Dui)

fetch(url, {
    method: 'POST',
    body: formData
}).then(response => response.json())
.then(data => {

    if(data.ok){
        document.getElementById('Dui').value = ''
        document.getElementById('validaDui').innerHTML = 'Dui no disponible'
    } else {
        document.getElementById('validaDui').innerHTML = ''
    }

    })
}


</script>
</body>
</html>
