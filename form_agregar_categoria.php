<?php
// Agregar categoría en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('../../conexion.php');

    // Obtener el nombre de la categoría desde el formulario
    $nombre_cat = $_POST['nombre_cat'];

    // Insertar la nueva categoría en la base de datos
    $query = "INSERT INTO categoria (nombre_cat) VALUES (?)";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$nombre_cat]);

    // Redirigir al listado de categorías después de agregar
    header("Location: ../../categorias_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Categoría - EmpleoTotal</title>
    <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

    <!-- Formulario de agregar categoría -->
    <div class="formulario">
        <!-- Logo en la esquina derecha dentro del formulario -->
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Agregar Nueva Categoría</h2>
        <form action="form_agregar_categoria.php" method="POST">
            <div class="form-group">
                <label for="nombre_cat">Nombre de la Categoría</label>
                <input type="text" id="nombre_cat" name="nombre_cat" required>
            </div>
            <button type="submit" class="btn-agregar">Agregar Categoría</button>
        </form>
    </div>

</div>

</body>
</html>
