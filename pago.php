<?php
 
require_once 'config/config.php';
require_once 'config/database.php';

$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        
        $sql = $con->prepare("SELECT id, nombre, precio, descuento FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $producto = $sql->fetch(PDO::FETCH_ASSOC);
        if ($producto) {
            $producto['cantidad'] = $cantidad; // Agrega la cantidad al producto
            $lista_carrito[] = $producto; // Agrega el producto al array de lista_carrito
        }
    }
}else{
    header("Location: index.php");
    exit;
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
</head>
<body class="fondo1">
<?php include 'menu.php'; ?>
<!--aqui van el header -->
<!-- <header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">
        <strong>E.Gaming Shop</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="./index.php">Catálogo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
        </ul>
         <a href="#" class="btn btn-primary">
          Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
        </a>
      </div>
    </div>
  </div>
</header> -->
<!--aqui van los productos -->
<main>
   <div class="container"><!--aqui abre el container -->
   <div class="row">
    <div class="col-6">
        <h4>Detalles De Productos</h4>
    <div id="paypal-button-container"></div>

    </div>
    <div class="col-6">

     <div class="table responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($lista_carrito)){
        echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
    } else {
        $total = 0;
        foreach ($lista_carrito as $producto) {
            $_id = $producto['id'];
            $nombre = $producto['nombre'];
            $precio = $producto['precio'];
            $descuento = $producto['descuento'];
            $cantidad = $producto['cantidad'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $subtotal = $cantidad * $precio_desc;
            $total += $subtotal;
    ?>
            <tr>
                <td><?php echo $nombre; ?></td>

                <td>
                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                        <?php echo Moneda . number_format($subtotal, 2, '.', ','); ?>
                    </div>
                </td>
            </tr>
    <?php } ?>
    <tr>
        <!-- <td colspan="3"></td> -->
        <td colspan="2">
        <p class="h3 text-end" id="total"><?php echo Moneda . number_format($total, 2, '.', ',');?></p>
        </td>

    </tr>
</tbody>
                     <?php } ?>
        </table>
     </div>
     <!--
      < ?php if ($lista_carrito != null) { ?>
     <div class="row">
     </div>
< ?php } ?>
      -->
   </div>
   </div>
   </div>
   <!--aqui cierra el container -->
</main>

<!-- Modal 
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModal">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de eliminar el producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-eliminar" class="btn btn-danger" onclick="eliminar()">Eliminar</button>

      </div>
    </div>
  </div>
</div>
-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <! <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>=&currency=<?php echo CURRENCY?>YOUR_COMPONENTS"></script>

<script src="https://www.paypal.com/sdk/js?client-id=AaIQ9y97v3FnEfn0l3a8epKZSi0M-nPXnxe3wcVBSxLPuZHKMFmug48fsfMw-2qn52VQYOp32TFwpGwo&components=buttons"></script>

<script>
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'blue',
        label: 'pay',
      },
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: <?php echo $total; ?>
            }
          }]
        });
      },

       onApprove: function (data, actions) {
        let URL = 'clases/captura.php'
        actions.order.capture().then(function (detalles){

          console.log(detalles)


          return fetch(URL, {
            method: 'post',
            headers: {
              'content-type': 'application/json'
            },
            body: JSON.stringify({
              detalles: detalles
            })
          }).then(function(response){
      window.location.href = "completado.php?key=" + detalles['id'];
          })
            
        });
      }, 
    

      onCancel: function (data) {
        alert('Pago Cancelado');
        console.log(data);
      },
    }).render('#paypal-button-container');
  </script>
<!--<script>
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'blue',
        label: 'pay',
      },
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: < ?php echo $total; ?>
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        let URL = 'clases/captura.php';
        return actions.order.capture().then(function(details) {
         console.log(details);
          alert('Transaction completed by ' + details.payer.name.given_name);
          window.location.href
        });
      },
      
      onCancel: function (data) {
        alert('Payment Cancelled');
        console.log(data);
      },
    }).render('#paypal-button-container');
  </script>
-->

</body>
</html>
