<?php
include 'includes/header.php';
include 'includes/db.php';
?>

<main>
    <article class="info-box">
        <h1><?php echo htmlspecialchars('¿Quiénes somos?', ENT_QUOTES, 'UTF-8'); ?></h1>
        <p>
            <?php echo htmlspecialchars('Somos una organización comprometida con brindar ayuda a las víctimas de la DANA. Nuestra misión es ofrecer apoyo, recursos y soluciones tecnológicas para facilitar la recuperación de las comunidades afectadas.', ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p>
            <?php echo htmlspecialchars('Con un equipo dedicado de profesionales y voluntarios, trabajamos para crear herramientas digitales que permitan mejorar la respuesta ante emergencias y fortalecer la solidaridad entre las personas.', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    </article>
</main>

<?php
include 'includes/footer.php';
?>