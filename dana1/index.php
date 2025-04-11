<?php
include 'includes/header.php';
//include 'includes/db.php';
?>

<div id="carruselInicio" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="css/Foto1.jpg" class="d-block w-100" alt="Primera imagen">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                <h2 class="display-4 fw-bold text-shadow">Bienvenido a Pueblos Unidos</h2>
                <p class="lead text-shadow">El pueblo ayuda al pueblo</p>
                <a href="login.php" class="btn btn-light btn-lg mt-3">Iniciar Sesión</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="css/Foto1.jpg" class="d-block w-100" alt="Segunda imagen">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                <h2 class="display-4 fw-bold text-shadow">Accede a Pueblos Unidos</h2>
                <p class="lead text-shadow">Regístrate y forma parte de la familia</p>
                <a href="registro.php" class="btn btn-light btn-lg mt-3">Registrarse</a>
            </div>
        </div>

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carruselInicio" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carruselInicio" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<?php
include 'includes/footer.php';
?>