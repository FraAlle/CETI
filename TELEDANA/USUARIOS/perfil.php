// 5. /usuarios/perfil.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

$id = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$usuario = $resultado->fetch_assoc();
?>
<h1>Perfil de Usuario</h1>
<p>Nombre: <?php echo $usuario['nombre']; ?></p>
<p>Email: <?php echo $usuario['email']; ?></p>
<p>Rol: <?php echo $usuario['rol']; ?></p>
<a href="editar.php">Editar Perfil</a>
<?php include '../includes/footer.php'; ?>
