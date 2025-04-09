// 4. /contacto.php
<?php
session_start();
include 'includes/header.php';
?>
<h1>Contacto</h1>
<p>Ponte en contacto con nosotros para cualquier consulta.</p>
<form method="POST" action="emails/enviar_mensaje.php">
    <label>Tu Email:</label>
    <input type="email" name="email" required>
    <label>Mensaje:</label>
    <textarea name="mensaje" required></textarea>
    <button type="submit">Enviar</button>
</form>
<?php include 'includes/footer.php'; ?>
