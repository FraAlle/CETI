<?php
session_start();  // Inicia la sesión para almacenar información del usuario

$mysqli = new mysqli("localhost", "root", '', "tienda");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES,'UTF-8');

    // Prepared Statements7 para evitar inyecciones SQL
    $stmt = $mysqli->prepare("SELECT * FROM tienda WHERE email = ? AND password = ?;");
    if ($stmt === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Si las credenciales son correctas, inicia la sesión
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;  // Guardar el email en la sesión, o puedes guardar otro identificador

            // Redirigir a la página protegida
            header('Location: protected_page.php');
            exit();
        } else {
            echo "Credenciales incorrectas";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
    
?>