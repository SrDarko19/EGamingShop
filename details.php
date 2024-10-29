<?php
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$num_cart = isset($_SESSION['carrito']['productos']) ? count($_SESSION['carrito']['productos']) : 0;
$id = isset($_GET['id'])  ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
    echo "Error en la URL";
    exit;
}else{
    $token_tmp = hash_hmac('sha1',$id, KEY_TOKKEN);
    if($token == $token_tmp){

      $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
      $sql->execute([$id]);
      if($sql->fetchColumn() > 0){
        $sql = $con->prepare("SELECT nombre, descripcion, precio, genero, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
        
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $genero = $row['genero'];
        $descuento = $row['descuento'];
        $precio_descuento = $precio - (($precio * $descuento) / 100);
        $dir_images = "images/Productos/" . $id . "/";

        $rutaImg = $dir_images . "juego.jpg";

        if(!file_exists($rutaImg)){
            $rutaImg = "images/no-photo.jpg";
        }
        $imagenes = array();
        if(file_exists($dir_images))
        $dir = dir($dir_images);

        while(($archivo = $dir->read()) != false){
            if($archivo != 'juego.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))){
                $imagenes[] = $dir_images . $archivo;
            }
        }
        $dir->close();
      }
      $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    }else{
        echo "Error en la URL";
        exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fusion Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<style>
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
</style>
<body>
<!--aqui van el header -->
<?php include 'menu.php'; ?>
<!-- <header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <strong>E.Gaming Shop</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Catalogo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
        </ul>

        <a href="checkout.php" class="btn btn-primary">
    Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;?></span>
</a>

          
    </div>
  </div>
</header> -->
<!--aqui vam los productos -->
<main>
   <div class="container"> <!--aqui abre el container -->

   <div class="row">
    <div class="col-md-6 order-md-1">
    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo $rutaImg ?>" class="d-block w-100">
    </div>
      <?php foreach($imagenes as $img) { ?>
        <div class="carousel-item">
        <img src="<?php echo $img ?>" class="d-block w-100">
    </div>
    <?php } ?>

      <?php foreach($imagenes as $img) {?>
    <div class="carousel-item">
    <img src="<?php echo $img ?>" class="d-block w-100">
    </div>
    <?php } ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
      
    </div>
    <div class="col-md-6 order-md-2">
      <h2><?php echo $nombre; ?></h2>
      <?php if($descuento > 0){ ?>
      <p><del><?php echo Moneda . number_format($precio, 2, '.', ','); ?></del></p>
      <h2><?php echo Moneda . number_format($precio_descuento, 2, '.', ','); ?>
      <small class="text-success"><?php echo $descuento; ?>% descuento </small>
      </h2>
      <?php }else{  ?>

      <h2><?php echo Moneda . number_format($precio, 2, '.', ','); ?></h2>
      <?php } ?>
      <h5><?php echo $genero;?> </h5>
      <p class="lead">
        <?php echo $descripcion; ?>
      </p>

      <div class="col-3 my-3">

    Cantidad: <input class="form-control" id="cantidad" name="cantidad" type="number" min="1" max="10" value="1">

      </div>

      <div class="d-grid gap-3 col-10 mx-auto">
      <a class="btn btn-primary" href="checkout.php">Ir Al carrito Ahora</a>
        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id;?>, cantidad.value, 
        '<?php echo$token_tmp?>')">Agregar al carrito</button>
      
      </div>
    </div>
   </div>

</div> <!--aqui cierra el container -->
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  function addProducto(id, cantidad, token){
    let url = 'clases/carrito.php'
    let formData = new FormData()
    formData.append('id', id)
    formData.append('cantidad', cantidad)
    formData.append('token', token)
    fetch(url, {
      method: 'POST',
      body: formData,
      mode: 'cors'
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        let elemento = document.getElementById('num_cart')
        elemento.innerHTML = data.numero
       }else{
        //parte modificada agregar else
        alert("No hay suficientes existencias");

       }
    })
    }
</script>
</body>
</html>