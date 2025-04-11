<?php
include 'includes/header.php';
/*include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    

    $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'cliente')");
    $consulta->bind_param("sss", $nombre, $email, $password);

    if ($consulta->execute()) {
      $message = "Usuario registrado con éxito.";
      $alertType = "success"; // Tipo de alerta para éxito
  } else {
      $message = "Error al registrar el usuario: " . $consulta->error;
      $alertType = "danger"; // Tipo de alerta para error
  }
}*/
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Resultado del Registro</h5>
    </div>
    <div class="modal-body">
      <div class="alert alert-<?php echo $alertType; ?>" role="alert">
        <?php echo $message; ?>
      </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
    </div>
  </div>
</div>
</div>

<!-- Bootstrap JS y CSS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Mostrar el modal si se estableció el mensaje
<?php if (isset($message)): ?>
  var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
  myModal.show();
<?php endif; ?>
</script>


<main>
  <article class="info-box login-box">
    <h2>Registro</h2>
    <form method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

      <button type="submit" class="login-btn">Registrarse</button>
    </form>
  </article>
</main>

<?php
include 'includes/footer.php';
?>
