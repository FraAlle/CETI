// 4. /productos/agregar.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_tonkens = $_POST['precio_tonkens'];
    $categoria = $_POST['categoria'];
    $usuario_id = $_SESSION['usuario']['id'];
    
    $query = $conexion->prepare("INSERT INTO productos (usuario_id, nombre, descripcion, precio_tonkens, categoria, stock) VALUES (?, ?, ?, ?, ?, 1)");
    $query->bind_param("issis", $usuario_id, $nombre, $descripcion, $precio_tonkens, $categoria);
    
    if ($query->execute()) {
        echo "<p>Producto agregado correctamente.</p>";
    } else {
        echo "<p>Error al agregar el producto.</p>";
    }
}
?>
<h1>Agregar Producto</h1>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>
    <label>Precio (Tonkens):</label>
    <input type="number" name="precio_tonkens" required>
    <label>Categoría:</label>
    <select name="categoria" required>
        <option value="alimentos">Alimentos</option>
        <option value="limpieza">Limpieza</option>
        <option value="bricolaje">Bricolaje</option>
        <option value="transporte">Transporte</option>
    </select>
    <button type="submit">Agregar Producto</button>
</form>
<?php include '../includes/footer.php'; ?>
