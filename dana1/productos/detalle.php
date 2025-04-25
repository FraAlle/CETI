<?php
// filepath: /c:/xampp/htdocs/dana1/dana1/productos/detalle.php

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/db.php';
include '../includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Verificar si se recibió el ID del producto
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Obtener los datos del producto de forma segura
$query = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$producto = $resultado->fetch_assoc();

// Verificar que el producto exista
if (!$producto) {
    header("Location: index.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Detalle del Producto</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre: <?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?></h5>
            <p class="card-text"><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Precio (Tonkens):</strong> <?php echo htmlspecialchars($producto['precio_tonkens'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['categoria'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Stock:</strong> <?php echo htmlspecialchars($producto['stock'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="index.php" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>