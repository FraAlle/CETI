// 6. /emails/enviar_pedido.php
<?php
function enviarCorreoPedido($email, $mensaje) {
    $headers = "From: no-reply@dana.com";
    mail($email, "Confirmación de Pedido", $mensaje, $headers);
}
?>
