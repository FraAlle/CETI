<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/db.php';
include '../includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Función para sanitizar datos
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Manejar la acción de añadir al carrito (solo para solicitudes AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

    $id_producto = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);

    if ($id_producto && $cantidad > 0) {
        // Validar que el producto exista y tenga suficiente stock
        $query = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
        if (!$query) {
            error_log("Error en la consulta SQL: " . $conexion->error);
            echo json_encode(['success' => false, 'message' => 'Error interno del servidor.']);
            exit();
        }

        $query->bind_param("i", $id_producto);
        $query->execute();
        $producto = $query->get_result()->fetch_assoc();

        if (!$producto || $producto['stock'] < $cantidad) {
            echo json_encode(['success' => false, 'message' => 'Stock insuficiente o producto no encontrado.']);
            exit();
        }

        // Añadir al carrito
        if (!isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto] = $cantidad; // Cantidad inicial
        } else {
            $_SESSION['carrito'][$id_producto] += $cantidad; // Incrementar cantidad
        }

        echo json_encode(['success' => true, 'message' => 'Producto añadido al carrito con éxito.']);
        exit();
    } else {
        error_log("Datos inválidos recibidos: id_producto={$id_producto}, cantidad={$cantidad}");
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        exit();
    }
}

// Obtener la lista de productos de forma segura
$query = $conexion->prepare("SELECT id, nombre, descripcion, precio_tonkens, categoria, stock FROM productos");
$query->execute();
$resultado = $query->get_result();
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Productos</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio (Tonkens)</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo sanitize($producto['id']); ?></td>
                    <td><?php echo sanitize($producto['nombre']); ?></td>
                    <td><?php echo sanitize($producto['descripcion']); ?></td>
                    <td><?php echo sanitize($producto['precio_tonkens']); ?></td>
                    <td><?php echo sanitize($producto['categoria']); ?></td>
                    <td><?php echo sanitize($producto['stock']); ?></td>
                    <td>
                        <button class="btn btn-success btn-sm open-modal" data-id="<?php echo sanitize($producto['id']); ?>" data-nombre="<?php echo sanitize($producto['nombre']); ?>" data-stock="<?php echo sanitize($producto['stock']); ?>">Añadir al Carrito</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal para seleccionar cantidad -->
<div class="modal fade" id="cantidadModal" tabindex="-1" aria-labelledby="cantidadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cantidadModalLabel">Añadir al Carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="addToCartForm">
                    <input type="hidden" id="productoId" name="id">
                    <div class="mb-3">
                        <label for="productoNombre" class="form-label">Producto</label>
                        <input type="text" id="productoNombre" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Añadir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toasts para mostrar mensajes -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="successToastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="errorToastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.open-modal').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const nombre = this.getAttribute('data-nombre');
        const stock = this.getAttribute('data-stock');

        document.getElementById('productoId').value = id;
        document.getElementById('productoNombre').value = nombre;
        document.getElementById('cantidad').setAttribute('max', stock);
        document.getElementById('cantidad').value = 1;

        const modal = new bootstrap.Modal(document.getElementById('cantidadModal'));
        modal.show();
    });
});

document.getElementById('addToCartForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const id = document.getElementById('productoId').value;
    const cantidad = document.getElementById('cantidad').value;

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            action: 'add_to_cart',
            id: id,
            cantidad: cantidad
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const toast = new bootstrap.Toast(document.getElementById('successToast'));
            document.getElementById('successToastMessage').textContent = data.message;
            toast.show();
        } else {
            const toast = new bootstrap.Toast(document.getElementById('errorToast'));
            document.getElementById('errorToastMessage').textContent = data.message;
            toast.show();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al añadir el producto al carrito.');
    });
});
</script>
<?php include '../includes/footer.php'; ?>
