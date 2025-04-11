<?php
session_start();
include '../includes/db.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Procesa el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);
    $remitente_id = $_SESSION['usuario']['id'];

    // Validación básica
    if (empty($email) || empty($mensaje)) {
        header("Location: ../contacto.php?error=empty_fields");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../contacto.php?error=invalid_email");
        exit();
    }

    // Inserta el mensaje en la base de datos
    $query = $conexion->prepare("INSERT INTO mensajes (remitente_id, destinatario_email, mensaje, fecha) VALUES (?, ?, ?, NOW())");
    $query->bind_param("iss", $remitente_id, $email, $mensaje);

    if ($query->execute()) {
        header("Location: ../contacto.php?success=1");
        exit();
    } else {
        header("Location: ../contacto.php?error=database_error");
        exit();
    }
} else {
    // Si se accede al archivo directamente, redirige al formulario de contacto
    header("Location: ../contacto.php");
    exit();
}
?>
<?php
function enviarCorreoMensaje($email, $asunto, $mensaje) {
    $headers = "From: no-reply@dana.com";
    mail($email, $asunto, $mensaje, $headers);
}
?>
