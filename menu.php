<style>
    /* Estilos personalizados */
    .navbar {
        background-color: #343a40;
        padding: 10px 20px;
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
        margin-right: 20px;
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

    /* Ajustes responsivos */
    @media (max-width: 576px) {
        .navbar-brand {
            font-size: 1.2rem;
        }

        .nav-link {
            font-size: 1rem;
        }

        .btn-cart {
            margin: 0;
        }

        .input-group {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <strong>Fusion Games</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Catálogo</a>
                    </li>
                </ul>

                <form action="index.php" method="get" class="d-flex" autocomplete="off">
                    <div class="input-group">
                        <input type="text" name="q" id="q" class="form-control form-control-sm" placeholder="Buscar..." aria-describedby="icon-buscar">
                        <button type="submit" id="icon-buscar" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-search"></i> buscar
                        </button>
                    </div>
                </form>

                <a href="checkout.php" class="btn-cart btn-sm">
                    <svg class="icon-cart" viewBox="0 0 24.38 30.52" height="30.52" width="24.38" xmlns="http://www.w3.org/2000/svg">
                        <title>Carrito</title>
                        <path transform="translate(-3.62 -0.85)" d="M28,27.3,26.24,7.51a.75.75,0,0,0-.76-.69h-3.7a6,6,0,0,0-12,0H6.13a.76.76,0,0,0-.76.69L3.62,27.3v.07a4.29,4.29,0,0,0,4.52,4H23.48a4.29,4.29,0,0,0,4.52-4ZM15.81,2.37a4.47,4.47,0,0,1,4.46,4.45H11.35a4.47,4.47,0,0,1,4.46-4.45Zm7.67,27.48H8.13a2.79,2.79,0,0,1-3-2.45L6.83,8.34h3V11a.76.76,0,0,0,1.52,0V8.34h8.92V11a.76.76,0,0,0,1.52,0V8.34h3L26.48,27.4a2.79,2.79,0,0,1-3,2.44Zm0,0"></path>
                    </svg>
                    <span id="num_cart" class="quantity"><?php echo $num_cart; ?></span>
                </a>

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
        </div>
    </nav>
</header>
