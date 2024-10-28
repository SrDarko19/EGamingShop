<?php include 'config/config.php'; 

if (!isset($_SESSION['user_type'])){
    header('Location: index.php');
    exit;
}

if ($_SESSION['user_type'] != 'admin') {
    header('Location: index.php');
    exit;
}

include 'header.php'; ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </main>

<?php include 'footer.php'; ?>
