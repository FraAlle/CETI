<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verifica si el usuario ha iniciado sesión
function verificarSesion() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../login.php");
        exit();
    }
}
verificarSesion();

$id_usuario = $_SESSION['usuario']['id'];

// Consulta para obtener los mensajes
$query = $conexion->prepare("
    SELECT 
        m.id, 
        u.nombre AS remitente, 
        m.mensaje, 
        m.fecha 
    FROM mensajes m 
    JOIN usuarios u ON m.remitente_id = u.id 
    WHERE m.destinatario_id = ? 
    ORDER BY m.fecha DESC
");
$query->bind_param("i", $id_usuario);
$query->execute();
$resultado = $query->get_result();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #333;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    td {
        color: #333;
    }
</style>

<h1>Bandeja de Entrada</h1>
<table>
    <thead>
        <tr>
            <th>Remitente</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($mensaje = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($mensaje['remitente']); ?></td>
                <td><?php echo htmlspecialchars($mensaje['mensaje']); ?></td>
                <td><?php echo htmlspecialchars($mensaje['fecha']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include '../includes/footer.php'; ?>