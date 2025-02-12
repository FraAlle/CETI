<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CETI PPS</title>
<style>
/* Importar Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

/* Estilos generales */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
}

/* Modos de color */
body.light-mode {
    background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
    color: black;
}

body.dark-mode {
    background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
    color: white;
}

/* Contenedor principal */
.container {
    text-align: center;
    width: 90%;
    max-width: 600px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: background 0.5s ease-in-out;
}

/* Logo */
.logo {
    width: 120px;
    height: auto;
    margin-bottom: 15px;
}

/* Título */
header {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #4CAF50;
}

/* Botones */
.buttons {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.button {
    background: #16a085;
    color: white;
    font-size: 20px;
    padding: 15px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    font-weight: bold;
}

.button:hover {
    background: #1abc9c;
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* Botón de modo oscuro/claro */
.theme-toggle {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    background-color: #222;
    color: white;
}

.theme-toggle:hover {
    background-color: #444;
}

body.light-mode .theme-toggle {
    background-color: #ddd;
    color: black;
}

body.light-mode .theme-toggle:hover {
    background-color: #bbb;
}
</style>
</head>
<body>
<div class="container">
<!-- Logotipo -->
<img src="logo.png" alt="CETI Logo" class="logo">

<header>CETI PPS</header>

<div class="buttons">
<a href="registro.php" class="button">📌 Registro</a>
<a href="quienes.php" class="button">❓ ¿Quiénes Somos?</a>
<a href="contacto.php" class="button">📞 Contacto</a>
</div>

<!-- Botón de modo oscuro/claro -->
<button class="theme-toggle" onclick="toggleTheme()">🌙 Modo Oscuro</button>
</div>

<script>
// Verifica si hay una preferencia guardada en localStorage
document.addEventListener("DOMContentLoaded", function() {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        document.querySelector(".theme-toggle").textContent = "☀️ Modo Claro";
    } else {
        document.body.classList.add("light-mode");
        document.querySelector(".theme-toggle").textContent = "🌙 Modo Oscuro";
    }
});

// Función para alternar el tema
function toggleTheme() {
    if (document.body.classList.contains("dark-mode")) {
        document.body.classList.remove("dark-mode");
        document.body.classList.add("light-mode");
        localStorage.setItem("theme", "light");
        document.querySelector(".theme-toggle").textContent = "🌙 Modo Oscuro";
    } else {
        document.body.classList.remove("light-mode");
        document.body.classList.add("dark-mode");
        localStorage.setItem("theme", "dark");
        document.querySelector(".theme-toggle").textContent = "☀️ Modo Claro";
    }
}
</script>
</body>
</html>
