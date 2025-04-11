// 4. /includes/functions.php
<?php
function verificarSesion() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: /DANA/login.php");
        exit();
    }
}

function redirigirSiNoEsAdmin() {
    if ($_SESSION['usuario']['rol'] !== 'administrador') {
        header("Location: /DANA/index.php");
        exit();
    }
}
?>

