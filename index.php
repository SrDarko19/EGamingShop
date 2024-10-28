<?php
require_once 'config/config.php';
require_once 'config/database.php';

$db = new Database();
$con = $db->conectar();

$idCategoria = $_GET['cat'] ?? '';
$orden = $_GET['orden'] ?? '';
$buscar = $_GET['q'] ?? '';

$filtro = '';

$orders= [
    'asc'=> 'nombre ASC',
    'desc'=> 'nombre DESC',
    'precio_alto'=> 'precio DESC',
    'preci_bajo'=> 'precio ASC',
];

$order= $orders[$orden]?? '';

if(!empty($order)){
   $order= "ORDER BY $order";
}

$params = [];

$query = "SELECT id, nombre, precio, descuento, genero FROM productos WHERE activo=1 $order";


if($buscar != ''){
    $query .= " AND (nombre LIKE ? OR descripcion LIKE ?)";
    $params[] = "%$buscar%";
    $params[] = "%$buscar%";
    
    // $filtro = "AND (nombre LIKE '%$buscar%' || descripcion LIKE '%$buscar%')";
}

if ($idCategoria != '') {
    $query .= " AND id_categoria = ?";
    $params[] = $idCategoria;
}

$query = $con->prepare($query);
$query->execute($params);


/*
$comando = $con->prepare("SELECT id, nombre, precio, genero, descuento FROM productos WHERE activo=1 $filtro AND id_categoria = ?
$order");
$comando->execute([$idCategoria]);
} else {
    $comando = $con->prepare("SELECT id, nombre, precio, descuento, genero FROM productos WHERE activo=1 $filtro $order");
    $comando->execute();
} */


$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
//Copiar y pegar

$sqlCategorias = $con->prepare("SELECT id, nombre FROM categorias WHERE activo=1");
$sqlCategorias->execute();
$categorias = $sqlCategorias->fetchAll(PDO::FETCH_ASSOC);


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
    background-image: url('images/Background/background.png'); /* Cambia esto a la ruta de tu imagen */
    background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
    background-position: center; /* Centra la imagen */
    background-repeat: no-repeat; /* Evita que la imagen se repita */
    margin: 0;
    font-family: Arial, sans-serif;
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

.CartBtn {
    width: 140px;
    height: 40px;
    border-radius: 12px;
    border: none;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition-duration: .5s;
    overflow: hidden;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.103);
    position: relative;
}

.IconContainer {
    position: absolute;
    left: -50px;
    width: 30px;
    height: 30px;
    background-color: transparent;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    z-index: 2;
    transition-duration: .5s;
}

.icon {
    border-radius: 1px;
}

.text {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(17, 17, 17);
    z-index: 1;
    transition-duration: .5s;
    font-size: 1.04em;
    font-weight: 600;
}

.CartBtn:hover .IconContainer {
    transform: translateX(58px);
    border-radius: 40px;
    transition-duration: .5s;
}

.CartBtn:hover .text {
    transform: translate(10px,0px);
    transition-duration: .5s;
}

.CartBtn:active {
    transform: scale(0.95);
    transition-duration: .5s;
}

.btn-cart {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 10px;
    border: none;
    background-color: transparent;
    position: relative;
}

.card.xd {
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco transparente */
}

.card.xd:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    border-bottom: 1px solid #e0e0e0;
    height: 200px;
    object-fit: cover;
}

.card-body {
    padding: 15px;
    display: flex;
    flex-direction: column;
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.card-text {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.text-danger {
    font-weight: bold;
}



    </style>
</head>
<body>
    <?php include 'menu.php'; ?>

    <main>
        <div class="container">
            <!--aqui abre el container -->
            <div class="row">
                <div class="col-3">
                <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        Categorías
    </div>
    <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action">
            Todo
        </a>
        <?php foreach($categorias as $categoria) { ?>
            <a href="index.php?cat=<?php echo $categoria['id']; ?>" class="list-group-item list-group-item-action <?php if($idCategoria == $categoria['id']) echo 'active'; ?>">
                <?php echo $categoria['nombre']; ?>
            </a>
        <?php } ?>
    </div>
</div>
</div>
            <div class="col-12 col-md-9">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 justify-content-end g-4">
                    <div class="col mb-2">
                        <form action="index.php" id="ordenForm" method="get">
                            <input type="hidden" name="cat" id="cat" value="<?php echo $idCategoria; ?>">
                        <select name="orden" id="orden" class="form-select form-seletc-sm" onchange="submitForm()">
                            <option value="">Ordenar Por</option>
                            <option value="precio_alto" <?php echo ($orden==='precio_alto')? 'selected': '';?>>Precios más altos</option>
                            <option value="precio_bajo" <?php echo ($orden==='precio_bajo')? 'selected': '';?>>Precios más bajos</option>
                            <option value="asc" <?php echo ($orden==='asc')? 'selected': '';?>>Nombre A-Z</option>
                            <option value="desc" <?php echo ($orden==='desc')? 'selected': '';?>>Nombre Z-A</option>
                        </select>
                        </form>

                    </div>
                </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
                <?php foreach($resultado as $row) {  
                    $id = $row['id'];
                    $imagen = "images/Productos/" . $id . "/juego.jpg";
                    if(!file_exists($imagen)){
                        $imagen = "images/no-photo.jpg";
                    }

                    // Cálculo del precio con descuento
                    $precio = $row['precio'];
                    $descuento = $row['descuento'];
                    $precio_final = $precio - (($precio * $descuento) / 100);
                ?>
            <div class="col">
        <div class="card xd shadow-sm h-100">
            <img src="<?php echo $imagen; ?>" class="card-img-top" alt="<?php echo $row['nombre']; ?>">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                <p class="card-text"><?php echo $row['genero']; ?></p>
                <?php if($descuento > 0) { ?>
                    <p class="card-text"><del>$<?php echo number_format($precio, 2, '.', ','); ?></del></p>
                    <p class="card-text text-danger">$<?php echo number_format($precio_final, 2, '.', ','); ?> <small class="text-success"><?php echo $descuento; ?>% descuento</small></p>
                <?php } else { ?>
                    <p class="card-text">$<?php echo number_format($precio, 2, '.', ','); ?></p>
                <?php } ?>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <div class="btn-group">
                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKKEN); ?>" class="btn">
                            Detalles
                        </a>
                    </div>
                    <button class="btn" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKKEN); ?>')"> Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
    </div>
            
                <?php } ?>
                  </div>
                </div>
            </div>
        </div>
        <!--aqui cierra el container -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function addProducto(id, token){
            let url = 'clases/carrito.php';
            let formData = new FormData();
            formData.append('id', id);
            formData.append('token', token);
            
            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    let elemento = document.getElementById('num_cart');
                    elemento.innerHTML = data.numero; // Actualiza el número de productos en el carrito
                }else{
                    alert("No hay suficientes existencias") //agregue ese alert
                }
            });
        }
        function submitForm(){
            document.getElementById('ordenForm').submit();
        }
    </script>
</body>
</html>
