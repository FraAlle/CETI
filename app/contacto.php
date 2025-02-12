<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contacto</title>
<style>
/* Importar Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

/* Estilos generales */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #1b4332, #2d6a4f, #40916c);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.contacto {
    max-width: 500px;
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    text-align: left;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeIn 1s ease-in-out;
}

/* Animación de entrada */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

h2 {
    text-align: center;
    font-size: 26px;
    margin-bottom: 20px;
    color: #b7e4c7;
}

p {
    font-size: 16px;
    line-height: 1.6;
    color: #d1e8e2;
}

p strong {
    color: #b7e4c7;
}

.btn-volver {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background-color: #40916c;
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.3s ease-in-out;
}

.btn-volver:hover {
    background-color: #2d6a4f;
}

</style>
</head>
<body>
<div class="contacto">
<h2>Datos de Contacto</h2>
<p><strong>Nombre:</strong> DevSecOps</p>
<p><strong>Teléfono:</strong> +34 666 666 666</p>
<p><strong>Email:</strong> juan.perez@example.com</p>
<p><strong>Dirección:</strong> Avinguda de l'Advocat Fausto Caruana, 46500 Sagunt, Valencia</p>

<a href="index.php" class="btn-volver">Volver al Inicio</a>
</div>
</body>
</html>
