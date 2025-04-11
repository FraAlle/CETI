<?php
include 'includes/header.php'; // Mueve esto al inicio
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex; /* Activa Flexbox */
        justify-content: center; /* Centra horizontalmente */
        align-items: center; /* Centra verticalmente */
        height: 100vh; /* Ocupa toda la altura de la ventana */
        flex-direction: column; /* Asegura que los elementos estén en columna */
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
    }

    p {
        margin-bottom: 20px;
        text-align: center;
    }

    table {
        width: 80%; /* Ajusta el ancho de la tabla */
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Agrega un poco de sombra */
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #333;
        color: white;
    }

    td {
        background-color: #fff;
    }

    a {
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
<h1>Bienvenido a DANA</h1>
<p>Explora los productos disponibles en nuestra tienda de voluntariado.</p>
<table>
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio (Tonkens)</th>
        <th>Acción</th>
    </tr>
    <tr>
        <td><?php echo $producto['nombre']; ?></td>
        <td><?php echo $producto['descripcion']; ?></td>
        <td><?php echo $producto['precio_tonkens']; ?></td>
        <td><a href="carrito/index.php?add=<?php echo $producto['id']; ?>">Añadir al Carrito</a></td>
    </tr>
</table>
<?php include 'includes/footer.php'; ?>