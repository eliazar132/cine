<?php
session_start();
include 'config.php';

// Verificar que haya usuario
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Verificar que se haya enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelicula = (int)$_POST['id_pelicula'];
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $fecha = date('Y-m-d H:i:s');

    // Insertar opinión en la base de datos
    $sql = "INSERT INTO opiniones (id_pelicula, usuario, comentario, fecha) 
            VALUES ($id_pelicula, '$usuario', '$comentario', '$fecha')";

    if ($conn->query($sql)) {
        header("Location: index.php"); // Redirige al index tras agregar
        exit();
    } else {
        die("Error al agregar opinión: " . $conn->error);
    }
} else {
    header("Location: index.php");
    exit();
}
?>
