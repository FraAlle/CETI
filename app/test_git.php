<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CETI PPS</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

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

body.light-mode {
    background: linear-gradient(135deg, #ffffff, #e6e6e6);
    color: #333;
}

body.dark-mode {
    background: linear-gradient(135deg, #121212, #1e1e1e);
    color: white;
}

.container {
    text-align: center;
    width: 90%;
    max-width: 500px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: background 0.5s ease-in-out;
}

.logo {
    width: 100px;
    margin-bottom: 15px;
}

header {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #16a085;
}

.buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.button {
    background: #16a085;
    color: white;
    font-size: 18px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    cursor: pointer;
}

.button:hover {
    background: #1abc9c;
    transform: scale(1.05);
}

.theme-toggle {
    margin-top: 20px;
    padding: 12px 20px;
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
<img src="logo.png" alt="CETI Logo" class="logo">
<header>CETI PPS</header>
<div class="buttons">
<a href="registro.php" class="button">📌 Registro</a>
<a href="quienes.php" class="button">❓ ¿Quiénes Somos?</a>
<a href="contacto.php" class="button">📞 Contacto</a>
</div>
<button class="theme-toggle" onclick="toggleTheme()">🌙 Modo Oscuro</button>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        document.querySelector(".theme-toggle").textContent = "☀️ Modo Claro";
    } else {
        document.body.classList.add("light-mode");
        document.querySelector(".theme-toggle").textContent = "🌙 Modo Oscuro";
    }
});

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