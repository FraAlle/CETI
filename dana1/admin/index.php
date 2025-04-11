// /admin/index.php
<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: ../index.php");
    exit();
}
include '../includes/header.php';
?>
<h1>Panel de Administración</h1>
<nav>
    <ul>
        <li><a href="usuarios.php">Gestión de Usuarios</a></li>
        <li><a href="productos.php">Gestión de Productos</a></li>
        <li><a href="pedidos.php">Gestión de Pedidos</a></li>
    </ul>
</nav>
<?php include '../includes/footer.php'; ?>

