// 3. /admin/usuarios.php
<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: ../index.php");
    exit();
}
$resultado = $conexion->query("SELECT * FROM usuarios");
include '../includes/header.php';
?>
<h1>Gestión de Usuarios</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
    </tr>
    <?php while ($usuario = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nombre']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['rol']; ?></td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
