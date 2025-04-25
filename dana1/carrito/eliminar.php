<?php
// filepath: /c:/xampp/htdocs/dana1/dana1/carrito/eliminar.php

session_start();
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Verificar si el usuario tiene el rol de "cliente"
if (!isset($_SESSION['usuario']['rol']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    error_log("Acceso denegado: Usuario sin permisos intentó acceder a eliminar.php");
    echo "<div class='container mt-5'><p class='text-center'>Acceso denegado. Esta sección es solo para clientes.</p></div>";
    include '../includes/footer.php';
    exit();
}

// Verificar si se recibió el ID del producto
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    error_log("ID de producto inválido recibido en eliminar.php");
    echo "<div class='container mt-5'><p class='text-center text-danger'>Error: Producto inválido.</p></div>";
    include '../includes/footer.php';
    exit();
}

$id_producto = (int) $_GET['id'];

// Verificar si el producto está en el carrito
if (isset($_SESSION['carrito'][$id_producto])) {
    unset($_SESSION['carrito'][$id_producto]); // Eliminar el producto del carrito
    $_SESSION['mensaje'] = "Producto eliminado del carrito con éxito.";
    error_log("Producto con ID {$id_producto} eliminado del carrito.");
} else {
    $_SESSION['mensaje'] = "El producto no se encuentra en el carrito.";
    error_log("Intento de eliminar un producto no existente en el carrito. ID: {$id_producto}");
}

// Redirigir al carrito
header("Location: index.php");
exit();