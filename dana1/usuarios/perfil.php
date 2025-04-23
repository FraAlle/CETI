<?php
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

$id = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$usuario = $resultado->fetch_assoc();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Perfil de Usuario</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Información Personal</h5>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['rol'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="editar.php" class="btn btn-primary">Editar Perfil</a>
        </div>
    </div>

    <!-- Opciones según el rol -->
    <div class="mt-4">
        <?php if ($usuario['rol'] === 'administrador'): ?>
            <h5>Opciones de Administrador</h5>
            <a href="../admin/dashboard.php" class="btn btn-success">Ir al Panel de Administración</a>
        <?php elseif ($usuario['rol'] === 'voluntario'): ?>
            <h5>Opciones de Voluntario</h5>
            <a href="../productos/mis_productos.php" class="btn btn-success">Gestionar Mis Productos</a>
        <?php elseif ($usuario['rol'] === 'cliente'): ?>
            <h5>Opciones de Cliente</h5>
            <a href="../carrito/index.php" class="btn btn-success">Ver Carrito</a>
            <a href="../pedido.php" class="btn btn-success">Mis Pedidos</a>
        <?php endif; ?>
    </div>

    <!-- Cancelar Cuenta -->
    <div class="mt-4">
        <h5>Cancelar Cuenta</h5>
        <form action="cancelar_cuenta.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar tu cuenta? Esta acción no se puede deshacer.');">
            <button type="submit" class="btn btn-danger">Solicitar Cancelación de Cuenta</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
