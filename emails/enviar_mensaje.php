// 7. /emails/enviar_mensaje.php
<?php
function enviarCorreoMensaje($email, $asunto, $mensaje) {
    $headers = "From: no-reply@dana.com";
    mail($email, $asunto, $mensaje, $headers);
}
?>
