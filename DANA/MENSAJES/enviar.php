<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verifica si el usuario ha iniciado sesión
function verificarSesion() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../login.php");
        exit();
    }
}
verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $remitente_id = $_SESSION['usuario']['id'];
    $destinatario_id = intval($_POST['destinatario_id']);
    $mensaje = trim($_POST['mensaje']);
    
    if (!empty($mensaje)) {
        $query = $conexion->prepare("INSERT INTO mensajes (remitente_id, destinatario_id, mensaje, fecha) VALUES (?, ?, ?, NOW())");
        $query->bind_param("iis", $remitente_id, $destinatario_id, $mensaje);
        
        if ($query->execute()) {
            $success = "Mensaje enviado correctamente.";
        } else {
            $error = "Error al enviar el mensaje. Por favor, inténtalo de nuevo.";
        }
    } else {
        $error = "El mensaje no puede estar vacío.";
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        max-width: 500px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .message {
        text-align: center;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .message.success {
        color: green;
    }

    .message.error {
        color: red;
    }
</style>

<h1>Enviar Mensaje</h1>

<?php if (isset($success)): ?>
    <p class="message success"><?php echo htmlspecialchars($success); ?></p>
<?php elseif (isset($error)): ?>
    <p class="message error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST">
    <label for="destinatario_id">Destinatario ID:</label>
    <input type="number" id="destinatario_id" name="destinatario_id" required>
    
    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
    
    <button type="submit">Enviar</button>
</form>

<?php include '../includes/footer.php'; ?>