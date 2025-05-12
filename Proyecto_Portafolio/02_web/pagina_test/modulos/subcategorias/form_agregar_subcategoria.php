<?php
// Agregar subcategoría en la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('../../conexion.php');

    // Obtener los datos del formulario
    $nombre_sub_cat = $_POST['nombre_sub_cat'];
    $categoria_id_categora = $_POST['categoria_id_categora'];

    // Insertar la nueva subcategoría en la base de datos
    $query = "INSERT INTO sub_cat (nombre_sub_cat, categoria_id_categora) VALUES (?, ?)";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$nombre_sub_cat, $categoria_id_categora]);

    // Redirigir al listado de subcategorías después de agregar
    header("Location: ../../subcategorias_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Subcategoría - EmpleoTotal</title>
    <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

    <!-- Formulario de agregar subcategoría -->
    <div class="formulario">
        <!-- Logo en la esquina derecha dentro del formulario -->
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Agregar Nueva Subcategoría</h2>
        <form action="form_agregar_subcategoria.php" method="POST">
            <div class="form-group">
                <label for="nombre_sub_cat">Nombre de la Subcategoría</label>
                <input type="text" id="nombre_sub_cat" name="nombre_sub_cat" required>
            </div>
            <div class="form-group">
                <label for="categoria_id_categora">Categoría</label>
                <select id="categoria_id_categora" name="categoria_id_categora" required>
                    <option value="">Seleccione una categoría</option>
                    <?php
                    // Obtener categorías de la base de datos para el select
                    include('../../conexion.php');
                    $queryCategorias = "SELECT * FROM categoria";
                    $stmtCategorias = $base_de_datos->prepare($queryCategorias);
                    $stmtCategorias->execute();
                    $categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

                    // Mostrar las opciones de categorías
                    foreach ($categorias as $categoria) {
                        echo "<option value='" . $categoria['id_categora'] . "'>" . $categoria['nombre_cat'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn-agregar">Agregar Subcategoría</button>
        </form>
    </div>

</div>

</body>
</html>
