<?php
session_start();
include 'includes/header.php';
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

    p {
        text-align: center;
        color: #555;
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

    textarea {
        resize: vertical;
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

<h1>Contacto</h1>
<p>Ponte en contacto con nosotros para cualquier consulta.</p>

<?php if (isset($_GET['success'])): ?>
    <p class="message success">Tu mensaje ha sido enviado correctamente.</p>
<?php elseif (isset($_GET['error'])): ?>
    <p class="message error">Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo.</p>
<?php endif; ?>

<form method="POST" action="emails/enviar_mensaje.php">
    <label for="email">Tu Email:</label>
    <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>
    
    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí" required></textarea>
    
    <button type="submit">Enviar</button>
</form>

<?php include 'includes/footer.php'; ?>