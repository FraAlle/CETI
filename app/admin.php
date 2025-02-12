<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "admin") {
    header("Location: login.php");
    exit();
}

include('db_connect.php');

$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Crear usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Contraseña en texto claro
    $rol = $_POST['rol'];

    // Hashear la contraseña antes de guardarla
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar el nuevo usuario con la contraseña hasheada en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES ('$nombre', '$apellido', '$email', '$password_hash', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nuevo usuario creado exitosamente.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todos los usuarios
$sql = "SELECT id, nombre, apellido, email, rol FROM usuarios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de Administración</title>
<style>
/* Importar Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

/* Estilos generales */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #1b4332, #2d6a4f, #40916c);
    color: white;
}

/* Contenedor principal */
.container {
    text-align: center;
    width: 90%;
    max-width: 800px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 20px;
    animation: fadeIn 1.2s ease-in-out;
}

/* Animación de entrada */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

h1 {
    font-size: 26px;
    margin-bottom: 20px;
    color: #b7e4c7;
}

/* Formulario */
.form-crear {
    background: rgba(255, 255, 255, 0.2);
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    text-align: left;
    display: block;
    margin-top: 10px;
}

input, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #b7e4c7;
    border-radius: 5px;
    outline: none;
    transition: all 0.3s ease-in-out;
    box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
}

input:focus, select:focus {
    border-color: #52b788;
    box-shadow: 0px 0px 10px rgba(82, 183, 136, 0.5);
}

input[type="submit"] {
    background-color: #52b788;
    color: white;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
    padding: 12px;
    border-radius: 6px;
    margin-top: 10px;
}

input[type="submit"]:hover {
    background-color: #74c69d;
}

/* Tabla */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #40916c;
    color: white;
}

/* Botón de eliminar */
.btn-eliminar {
    text-decoration: none;
    background-color: #e63946;
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.btn-eliminar:hover {
    background-color: #d62839;
}

/* Botón de cerrar sesión */
.btn-salir {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #b7e4c7;
    color: black;
    font-weight: bold;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.3s ease-in-out;
}

.btn-salir:hover {
    background: #74c69d;
}

/* Botones de navegación */
.btn-nav {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #40916c;
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.3s ease-in-out;
}

.btn-nav:hover {
    background: #2d6a4f;
}

</style>
</head>
<body>
<div class="container">
<h1>Panel de Administración</h1>
<p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["usuario"]); ?></strong> (Administrador)</p>

<!-- Botones de navegación -->
<div class="navegacion">
<a href="index.php" class="btn-nav">Inicio</a>
<a href="contacto.php" class="btn-nav">Contacto</a>
<a href="quienes.php" class="btn-nav">Quiénes Somos</a>
</div>

<!-- Formulario para crear un nuevo usuario -->
<div class="form-crear">
<h2>Crear Nuevo Usuario</h2>
<form action="admin.php" method="POST">
<label for="nombre">Nombre:</label>
<input type="text" name="nombre" id="nombre" required>

<label for="apellido">Apellido:</label>
<input type="text" name="apellido" id="apellido" required>

<label for="email">Correo Electrónico:</label>
<input type="email" name="email" id="email" required>

<label for="password">Contraseña:</label>
<input type="password" name="password" id="password" required>

<label for="rol">Rol:</label>
<select name="rol" id="rol" required>
<option value="admin">Administrador</option>
<option value="usuario">Usuario</option>
</select>

<input type="submit" value="Crear Usuario">
</form>
</div>

<!-- Tabla de usuarios -->
<h2>Lista de Usuarios</h2>
<table>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Email</th>
<th>Rol</th>
<th>Acciones</th>
</tr>
<?php while ($usuario = $resultado->fetch_assoc()): ?>
<tr>
<td><?php echo $usuario['id']; ?></td>
<td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
<td><?php echo htmlspecialchars($usuario['apellido']); ?></td>
<td><?php echo htmlspecialchars($usuario['email']); ?></td>
<td><?php echo htmlspecialchars($usuario['rol']); ?></td>
<td>
<a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn-eliminar">Eliminar</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<a href="logout.php" class="btn-salir">Cerrar Sesión</a>
</div>
</body>
</html>
