<?php
$servername = "localhost";
$username = "root"; // Cambia si tu usuario es otro
$password = "";     // Cambia si tu contraseña es otra
$dbname = "pelicula";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
