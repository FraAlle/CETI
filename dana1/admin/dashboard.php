<?php
include '../includes/header.php';
include '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verificar si el usuario está logueado y tiene el rol de administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: ../index.php");
    exit();
}

// Obtener estadísticas clave
$totalUsuarios = $conexion->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
$totalProductos = $conexion->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()['total'];
$totalPedidos = $conexion->query("SELECT COUNT(*) AS total FROM pedidos")->fetch_assoc()['total'];
$totalTonkens = $conexion->query("SELECT SUM(tonkens) AS total FROM usuarios")->fetch_assoc()['total'];
?>

<h1>Panel de Administración</h1>

<div class="dashboard-stats">
    <div class="stat">
        <h3>Total de Usuarios</h3>
        <p><?php echo htmlspecialchars($totalUsuarios, ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="usuarios.php">Ver Usuarios</a>
    </div>
    <div class="stat">
        <h3>Total de Productos</h3>
        <p><?php echo htmlspecialchars($totalProductos, ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="productos.php">Ver Productos</a>
    </div>
    <div class="stat">
        <h3>Total de Pedidos</h3>
        <p><?php echo htmlspecialchars($totalPedidos, ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="pedidos.php">Ver Pedidos</a>
    </div>
    <div class="stat">
        <h3>Tonkens Totales Distribuidos</h3>
        <p><?php echo htmlspecialchars($totalTonkens, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
</div>

<nav>
    <ul>
        <li><a href="usuarios.php">Gestión de Usuarios</a></li>
        <li><a href="productos.php">Gestión de Productos</a></li>
        <li><a href="pedidos.php">Gestión de Pedidos</a></li>
    </ul>
</nav>

<?php include '../includes/footer.php'; ?>

