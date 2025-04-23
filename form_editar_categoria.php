<?php
// Verificar si se ha pasado el ID de la categoría a editar
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de categoría no válido.");
}

// Conexión a la base de datos
include('../../conexion.php');

// Obtener el ID de la categoría
$id_categoria = $_GET['id'];

// Consultar la categoría actual
$query = "SELECT * FROM categoria WHERE id_categora = ?";
$stmt = $base_de_datos->prepare($query);
$stmt->execute([$id_categoria]);
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si la categoría existe
if (!$categoria) {
    die("Categoría no encontrada.");
}

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_cat = $_POST['nombre_cat'];

    // Actualizar la categoría en la base de datos
    $query = "UPDATE categoria SET nombre_cat = ? WHERE id_categora = ?";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$nombre_cat, $id_categoria]);

    // Redirigir al listado de categorías después de editar
    header("Location: ../../categorias_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - EmpleoTotal</title>
    <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

    <!-- Formulario de editar categoría -->
    <div class="formulario">
        <!-- Logo en la esquina derecha dentro del formulario -->
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Editar Categoría</h2>
        <form action="form_editar_categoria.php?id=<?= $categoria['id_categora'] ?>" method="POST">
            <div class="form-group">
                <label for="nombre_cat">Nombre de la Categoría</label>
                <input type="text" id="nombre_cat" name="nombre_cat" value="<?= htmlspecialchars($categoria['nombre_cat']) ?>" required>
            </div>
            <button type="submit" class="btn-agregar">Actualizar Categoría</button>
        </form>
    </div>

</div>

</body>
</html>
