// 6. /productos/editar.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$query = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$producto = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio_tonkens'];
    
    $query = $conexion->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio_tonkens = ? WHERE id = ?");
    $query->bind_param("ssii", $nombre, $descripcion, $precio, $id);
    if ($query->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar producto.";
    }
}
?>
<h1>Editar Producto</h1>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
    <label>Descripción:</label>
    <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
    <label>Precio (Tonkens):</label>
    <input type="number" name="precio_tonkens" value="<?php echo $producto['precio_tonkens']; ?>" required>
    <button type="submit">Guardar Cambios</button>
</form>
<?php include '../includes/footer.php'; ?>
