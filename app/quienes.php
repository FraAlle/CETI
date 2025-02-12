<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>¿Quiénes Somos?</title>
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
    text-align: center;
    flex-direction: column;
}

h1 {
    font-size: 36px;
    margin-bottom: 20px;
    color: #b7e4c7;
    text-align: center; /* Asegura que el título esté centrado */
}

p {
    font-size: 18px;
    line-height: 1.8;
    margin-bottom: 40px;
    color: #d1e8e2;
    width: 80%;
    max-width: 800px;
    text-align: center; /* Asegura que el texto del párrafo esté centrado */
}

.highlight {
    color: #52b788;
    font-weight: bold;
}

.team-container {
    display: flex;
    justify-content: center;
    align-items: stretch; /* Asegura que las tarjetas tengan la misma altura */
    gap: 30px;
    flex-wrap: wrap;
    width: 100%;
    margin-top: 40px;
}

.team-member {
    margin: 20px;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    width: 250px;
    height: 350px; /* Altura fija para todas las tarjetas */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Asegura que los elementos estén distribuidos correctamente */
    text-align: center; /* Centra el texto dentro de las tarjetas */
}

.team-member h3 {
    color: #b7e4c7;
    margin-bottom: 10px;
    text-align: center; /* Asegura que el título esté centrado en la tarjeta */
}

.team-member p {
    color: #d1e8e2;
    font-size: 14px;
    margin-bottom: 10px;
    flex-grow: 1; /* Hace que el párrafo ocupe el espacio restante */
    text-align: center; /* Centra el texto dentro de la tarjeta */
    display: flex;
    justify-content: center; /* Centra el texto verticalmente */
    align-items: center; /* Centra el texto verticalmente */
}

.team-member em {
    font-style: normal;
    color: #52b788;
}

/* Botón de contacto */
.button-container {
    margin-top: 30px;
    text-align: center; /* Centra el botón */
}

.button {
    display: inline-block;
    padding: 12px 25px;
    font-size: 16px;
    color: white;
    background-color: #52b788;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    margin: 10px;
    transition: background 0.3s ease-in-out;
}

.button:hover {
    background-color: #74c69d;
}

/* Ajuste para el texto de la empresa */
.empresa {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    text-align: center;
    margin-bottom: 30px;
}
</style>
</head>
<body>
<div>
<h1>¿Quiénes Somos?</h1>

<!-- Contenedor para centrar el info de la empresa -->
<div class="empresa">
<p>En <span class="highlight">[Nombre de la Empresa]</span>, somos un equipo multidisciplinario de estudiantes y profesionales comprometidos con la ciberseguridad. Nuestra misión es crear un entorno digital más seguro, a través de soluciones innovadoras y eficientes que protejan a individuos y organizaciones de las crecientes amenazas cibernéticas.</p>
</div>

<!-- Miembros del equipo dispuestos horizontalmente -->
<div class="team-container">
<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Co-Fundador & Especialista en Ciberseguridad</em></p>
<p>Con amplia experiencia en la protección de sistemas y redes, [Nombre] lidera la implementación de estrategias de seguridad avanzadas, asegurando la protección de datos en todos los niveles.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Investigador en Ciberseguridad</em></p>
<p>[Nombre] se especializa en la identificación y análisis de vulnerabilidades, contribuyendo al desarrollo de nuevas técnicas para mitigar riesgos en infraestructuras tecnológicas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>

<div class="team-member">
<h3>[Nombre]</h3>
<p><em>Desarrollador y Analista de Vulnerabilidades</em></p>
<p>[Nombre] tiene un enfoque práctico en la creación de herramientas de seguridad y en la evaluación de riesgos, mejorando la resiliencia digital de las empresas.</p>
</div>
</div>

<!-- Botón de contacto -->
<div class="button-container">
<a href="contacto.php" class="button">Contáctanos</a>
<a href="index.php" class="button">Inicio</a>
</div>
</div>
</body>
</html>
