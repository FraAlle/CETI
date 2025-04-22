// 5. /mensajes/enviar.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $remitente_id = $_SESSION['usuario']['id'];
    $destinatario_id = $_POST['destinatario_id'];
    $mensaje = $_POST['mensaje'];
    
    $query = $conexion->prepare("INSERT INTO mensajes (remitente_id, destinatario_id, mensaje, fecha) VALUES (?, ?, ?, NOW())");
    $query->bind_param("iis", $remitente_id, $destinatario_id, $mensaje);
    
    if ($query->execute()) {
        echo "<p>Mensaje enviado correctamente.</p>";
    } else {
        echo "<p>Error al enviar el mensaje.</p>";
    }
}
?>
<h1>Enviar Mensaje</h1>
<form method="POST">
    <label>Destinatario ID:</label>
    <input type="number" name="destinatario_id" required>
    <label>Mensaje:</label>
    <textarea name="mensaje" required></textarea>
    <button type="submit">Enviar</button>
</form>
<?php include '../includes/footer.php'; ?>
