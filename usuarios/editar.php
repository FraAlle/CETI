// 6. /usuarios/editar.php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    $query = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
    $query->bind_param("ssi", $nombre, $email, $id);
    if ($query->execute()) {
        header("Location: perfil.php");
        exit();
    } else {
        echo "Error al actualizar el perfil.";
    }
}
?>
<h1>Editar Perfil</h1>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    <button type="submit">Guardar Cambios</button>
</form>
<?php include '../includes/footer.php'; ?>
