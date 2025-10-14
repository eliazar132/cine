<?php
session_start();
include 'config.php';


// Obtener todas las películas
$peliculas = $conn->query("SELECT * FROM peliculas ORDER BY id");
$listaPeliculas = [];
while ($row = $peliculas->fetch_assoc()) {
    $listaPeliculas[] = $row;
}
$total = count($listaPeliculas);
if ($total == 0) die("No hay películas en la base de datos.");

// Índice actual
if (isset($_GET['i'])) {
    $indice = (int)$_GET['i'];
    if ($indice < 0) $indice = 0;
    if ($indice >= $total) $indice = $total - 1;
} else {
    $indice = rand(0, $total - 1);
}

// Película actual
$pelicula = $listaPeliculas[$indice];
?>

<?php
include 'config.php';

// Obtener todas las películas
$peliculas = $conn->query("SELECT * FROM peliculas ORDER BY id");
$listaPeliculas = [];
while ($row = $peliculas->fetch_assoc()) {
    $listaPeliculas[] = $row;
}
$total = count($listaPeliculas);
if ($total == 0) die("No hay películas en la base de datos.");

// Índice actual
if (isset($_GET['i'])) {
    $indice = (int)$_GET['i'];
    if ($indice < 0) $indice = 0;
    if ($indice >= $total) $indice = $total - 1;
} else {
    $indice = rand(0, $total - 1);
}

// Película actual
$pelicula = $listaPeliculas[$indice];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Recomendador de Películas</title>
<link rel="stylesheet" href="style.css">
<style>
/* Fuente moderna */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background: #000000; /* Fondo negro puro */
    color: #f0f0f0;
}

/* Contenedor */
.container {
    width: 90%;
    max-width: 1000px;
    margin: 40px auto;
    text-align: center;
}

/* Título principal */
h1 {
    font-size: 32px;
    margin-bottom: 30px;
    color: #ff4500; /* naranja intenso */
}

/* Card película */
.movie-card {
    background: #1c1c1c; /* negro oscuro */
    border-radius: 15px;
    padding: 20px;
    margin: 20px auto;
    max-width: 500px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.8);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.movie-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(255,69,0,0.5);
}
.movie-card img {
    width: 100%;
    max-width: 350px;
    border-radius: 12px;
    margin-bottom: 15px;
    border: 2px solid #ff4500;
}
.movie-card h3 {
    font-size: 24px;
    margin-bottom: 8px;
    color: #ffffff;
}
.movie-card p {
    font-size: 16px;
    color: #b0b0b0;
}

/* Navegación */
.navigation {
    margin-top: 25px;
}
.navigation a {
    padding: 10px 20px;
    margin: 5px;
    background: #ff4500;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s ease;
}
.navigation a:hover {
    background: #e03e00;
}

/* Formulario de opinión */
.form-box {
    margin-top: 35px;
    background: #1c1c1c;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(255,69,0,0.3);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
.form-box h2 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #fff;
}
.form-box textarea {
    width: 100%;
    border-radius: 8px;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #444;
    background: #0a0a0a;
    color: #fff;
    resize: vertical;
}
.form-box button {
    margin-top: 12px;
    padding: 10px 18px;
    background: #ff4500;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s ease;
}
.form-box button:hover {
    background: #e03e00;
}

/* Historial de opiniones */
.history {
    margin-top: 40px;
}
.history h2 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #fff;
}
.history table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.history th, .history td {
    border: 1px solid #444;
    padding: 8px 10px;
    text-align: left;
}
.history th {
    background: #ff4500;
    color: #fff;
}
.history td {
    background: #1c1c1c;
    color: #ccc;
}
.history td button {
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
}
.history td button:first-child {
    background: #ffc107;
    color: #000;
}
.history td button:last-child {
    background: #dc3545;
    color: #fff;
}
.history td button:hover {
    opacity: 0.85;
}
</style>
</head>
<body>
<div class="container">
    <h1>🎬 Recomendación de Películas para tu Fin de Semana 😉</h1>

    <!-- Película -->
    <div class="movie-card">
        <img src="<?php echo $pelicula['portada']; ?>" alt="<?php echo $pelicula['nombre']; ?>">
        <h3><?php echo $pelicula['nombre']; ?></h3>
        <p><?php echo $pelicula['genero'] . " | " . $pelicula['año']; ?></p>
    </div>

    <!-- Navegación -->
    <div class="navigation">
        <a href="index.php?i=<?php echo ($indice > 0) ? $indice - 1 : $total - 1; ?>">⬅ Anterior</a>
        <a href="index.php?i=<?php echo ($indice < $total - 1) ? $indice + 1 : 0; ?>">Siguiente ➡</a>
        <a href="index.php">🎲 Aleatoria</a>
    </div>

    <!-- Formulario de opinión -->
    <div class="form-box">
        <h2>¿Qué te parece darnos tu opinión sobre "<?php echo $pelicula['nombre']; ?>"?</h2>
        <form action="agregar.php" method="post">
    <textarea name="comentario" rows="3" placeholder="Escribe tu opinión aquí..." required></textarea>
    <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id']; ?>">
    <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
    <br>
    <button type="submit">Agregar Opinión</button>
</form>

    </div>

    <!-- Historial de opiniones -->
    <div class="history">
        <h2>📜 Todas las Opiniones Registradas</h2>
        <table>
            <tr>
                <th>Película</th>
                <th>Opinión</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            <?php
            $todas = $conn->query("SELECT opiniones.*, peliculas.nombre 
                                   FROM opiniones 
                                   JOIN peliculas ON opiniones.id_pelicula = peliculas.id 
                                   ORDER BY opiniones.fecha DESC");
            if ($todas->num_rows > 0):
                while($op = $todas->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $op['nombre']; ?></td>
                <td><?php echo nl2br($op['comentario']); ?></td>
                <td><?php echo $op['fecha']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $op['id']; ?>"><button>Editar</button></a>
                    <a href="eliminar.php?id=<?php echo $op['id']; ?>"><button>Eliminar</button></a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="4">No hay opiniones registradas aún.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>
<script>
// Seleccionamos todas las filas del historial
const filas = document.querySelectorAll('.history table tr');

// Aplicamos animación secuencial
filas.forEach((fila, index) => {
    // Ignorar la fila de encabezado
    if(index === 0) return;

    fila.style.opacity = 0; // start hidden
    fila.style.transform = 'translateY(20px)';
    fila.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    
    setTimeout(() => {
        fila.style.opacity = 1;
        fila.style.transform = 'translateY(0)';
    }, 200 * index); // 0.2s de retraso entre cada fila
});
</script>
<script>
// Animaciones secuenciales para la página

// Fade-in del título
const titulo = document.querySelector('h1');
titulo.style.opacity = 0;
titulo.style.transform = 'translateY(20px)';
titulo.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
setTimeout(() => {
    titulo.style.opacity = 1;
    titulo.style.transform = 'translateY(0)';
}, 200);

// Card película
const card = document.querySelector('.movie-card');
card.style.opacity = 0;
card.style.transform = 'translateY(20px)';
card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
setTimeout(() => {
    card.style.opacity = 1;
    card.style.transform = 'translateY(0)';
}, 400);

// Navegación
const nav = document.querySelector('.navigation');
nav.style.opacity = 0;
nav.style.transform = 'translateY(20px)';
nav.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
setTimeout(() => {
    nav.style.opacity = 1;
    nav.style.transform = 'translateY(0)';
}, 600);

// Formulario de opinión
const form = document.querySelector('.form-box');
form.style.opacity = 0;
form.style.transform = 'translateY(20px)';
form.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
setTimeout(() => {
    form.style.opacity = 1;
    form.style.transform = 'translateY(0)';
}, 800);

// Filas del historial
const filas = document.querySelectorAll('.history table tr');
filas.forEach((fila, index) => {
    if(index === 0) return; // ignorar encabezado
    fila.style.opacity = 0;
    fila.style.transform = 'translateY(20px)';
    fila.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    setTimeout(() => {
        fila.style.opacity = 1;
        fila.style.transform = 'translateY(0)';
    }, 1000 + index * 150); // 1s delay inicial + 0.15s entre filas
});
</script>
</body>
</html>
