<?php
include 'config.php';

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $opinion = $conn->query("SELECT * FROM opiniones WHERE id=$id")->fetch_assoc();
}

if(isset($_POST['comentario'], $_POST['id'])){
    $id = (int)$_POST['id'];
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $conn->query("UPDATE opiniones SET comentario='$comentario' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Opinión</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Editar Opinión</h1>
    <form action="" method="post">
        <textarea name="comentario" rows="4" required><?php echo htmlspecialchars($opinion['comentario']); ?></textarea>
        <input type="hidden" name="id" value="<?php echo $opinion['id']; ?>">
        <button type="submit">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
