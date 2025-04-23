<?php
include '../includes/header.php';
include '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verificar si el usuario está logueado y tiene el rol de administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: ../index.php");
    exit();
}

// Obtener estadísticas clave
$totalUsuarios = $conexion->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
$totalProductos = $conexion->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()['total'];
$totalPedidos = $conexion->query("SELECT COUNT(*) AS total FROM pedidos")->fetch_assoc()['total'];
$totalTonkens = $conexion->query("SELECT SUM(tonkens) AS total FROM usuarios")->fetch_assoc()['total'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Panel de Administración</h1>

    <!-- Estadísticas Clave -->
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de Usuarios</h5>
                    <p class="card-text"><?php echo htmlspecialchars($totalUsuarios, ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="usuarios.php" class="btn btn-primary">Ver Usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de Productos</h5>
                    <p class="card-text"><?php echo htmlspecialchars($totalProductos, ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="productos.php" class="btn btn-primary">Ver Productos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de Pedidos</h5>
                    <p class="card-text"><?php echo htmlspecialchars($totalPedidos, ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="pedidos.php" class="btn btn-primary">Ver Pedidos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tonkens Totales</h5>
                    <p class="card-text"><?php echo htmlspecialchars($totalTonkens, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="charts-container mt-5">
        <h2 class="text-center mb-4">Estadísticas en Gráficos</h2>
        <div class="row">
            <div class="col-md-6">
                <canvas id="usuariosChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="productosChart"></canvas>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="pedidosChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="tonkensChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Usuarios
    const usuariosCtx = document.getElementById('usuariosChart').getContext('2d');
    const usuariosChart = new Chart(usuariosCtx, {
        type: 'bar',
        data: {
            labels: ['Usuarios'],
            datasets: [{
                label: 'Total de Usuarios',
                data: [<?php echo $totalUsuarios; ?>],
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de Productos
    const productosCtx = document.getElementById('productosChart').getContext('2d');
    const productosChart = new Chart(productosCtx, {
        type: 'pie',
        data: {
            labels: ['Productos'],
            datasets: [{
                label: 'Total de Productos',
                data: [<?php echo $totalProductos; ?>],
                backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Gráfico de Pedidos
    const pedidosCtx = document.getElementById('pedidosChart').getContext('2d');
    const pedidosChart = new Chart(pedidosCtx, {
        type: 'line',
        data: {
            labels: ['Pedidos'],
            datasets: [{
                label: 'Total de Pedidos',
                data: [<?php echo $totalPedidos; ?>],
                backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de Tonkens
    const tonkensCtx = document.getElementById('tonkensChart').getContext('2d');
    const tonkensChart = new Chart(tonkensCtx, {
        type: 'doughnut',
        data: {
            labels: ['Tonkens'],
            datasets: [{
                label: 'Tonkens Totales',
                data: [<?php echo $totalTonkens; ?>],
                backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                borderColor: ['rgba(153, 102, 255, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<?php include '../includes/footer.php'; ?>

