<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar y sanitizar los datos de entrada
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $m_subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!$name || !$email || !$m_subject || !$message) {
        http_response_code(400);
        echo "<p>Error: Por favor, completa todos los campos correctamente.</p>";
        exit();
    }

    // Escapar datos antes de usarlos en el cuerpo del correo
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $m_subject = htmlspecialchars($m_subject, ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    $to = "grupo1@gmail.com"; // Cambia este correo por el tuyo
    $subject = "$m_subject: $name";
    $body = "Has recibido un nuevo mensaje desde el formulario de contacto.\n\n" .
            "Detalles:\n\nNombre: $name\n\nCorreo: $email\n\nAsunto: $m_subject\n\nMensaje:\n$message";
    $header = "From: $email\r\n";
    $header .= "Reply-To: $email\r\n";

    // Enviar el correo
    if (mail($to, $subject, $body, $header)) {
        echo "<p>Mensaje enviado correctamente. ¡Gracias por contactarnos!</p>";
    } else {
        http_response_code(500);
        echo "<p>Error: No se pudo enviar el mensaje. Inténtalo más tarde.</p>";
    }
}
?>

<main>
    <article class="info-box login-box">
        <h1 class="text-center mb-4">Contacto</h1>
        <form action="contacto.php" method="POST" id="contactForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Asunto:</label>
                <input type="text" id="subject" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Mensaje:</label>
                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </article>
</main>

<script>
    // Validación en el cliente
    document.getElementById('contactForm').addEventListener('submit', function (event) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        if (!name || !email || !subject || !message) {
            event.preventDefault();
            alert('Por favor, completa todos los campos.');
        }
    });
</script>

<?php
include 'includes/footer.php';
?>
