<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "<p>Error: Por favor, completa todos los campos correctamente.</p>";
        exit();
    }

    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $m_subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));

    $to = "grupo1@gmail.com"; // Cambia este correo por el tuyo
    $subject = "$m_subject: $name";
    $body = "Has recibido un nuevo mensaje desde el formulario de contacto.\n\n" .
            "Detalles:\n\nNombre: $name\n\nCorreo: $email\n\nAsunto: $m_subject\n\nMensaje:\n$message";
    $header = "From: $email\r\n";
    $header .= "Reply-To: $email\r\n";

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
        <form action="contacto.php" method="POST">
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
</main>>



<?php
include 'includes/footer.php';
?>