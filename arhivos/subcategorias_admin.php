<?php
include_once "conexion.php";

// Variables de búsqueda
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";
$filtroCategoria = isset($_GET['filtro_categoria']) ? trim($_GET['filtro_categoria']) : "";

// SQL de consulta
$sql = "SELECT sc.id_sub_cat, sc.nombre_sub_cat, c.nombre_cat 
        FROM sub_cat sc
        JOIN categoria c ON sc.categoria_id_categora = c.id_categora
        WHERE sc.nombre_sub_cat LIKE :busqueda";

// Añadimos la cláusula ORDER BY para ordenar las subcategorías de forma ascendente
$sql .= " ORDER BY sc.id_sub_cat ASC";  // Ordenar por ID ascendente

if ($filtroCategoria !== "") {
    $sql .= " AND sc.categoria_id_categora = :categoria";
}

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");

if ($filtroCategoria !== "") {
    $stmt->bindValue(':categoria', $filtroCategoria, PDO::PARAM_INT);
}

$stmt->execute();
$subcategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta de categorías para el filtro
$queryCategorias = "SELECT * FROM categoria";
$stmtCategorias = $base_de_datos->prepare($queryCategorias);
$stmtCategorias->execute();
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Subcategorías - EmpleoTotal</title>
    <link rel="stylesheet" href="estilos/crud_estilos.css">
</head>
<body>

<header>
    <nav class="barra-navegacion">
        <div class="logo">
            <img src="imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>
        <ul class="menu">
            <li><a href="inicio.html">Inicio</a></li>
            <li><a href="usuarios_admin.php">Usuarios</a></li>
            <li><a href="empresas_admin.php">Empresas</a></li>
            <li><a href="ofertas_empleo_admin.php">Ofertas de Empleo</a></li>
            <li><a href="categorias_admin.php">Categorías</a></li>
            <li><a href="subcategorias_admin.php">Subcategorías</a></li>
            <li><a href="estudios_admin.php">Estudios</a></li>
            <li><a href="hojas_vida_admin.php">Hojas de Vida</a></li>
            <li><a href="notificaciones_admin.php">Notificaciones</a></li>
            <li><a href="calificaciones_admin.php">Calificaciones</a></li>
        </ul>
        <div class="cerrar-sesion-container">
            <a href="http://localhost:3000" class="cerrar-sesion">Cerrar Sesión</a>
        </div>
    </nav>
</header>

<main class="contenedor">
    <h1>Gestión de Subcategorías</h1>

    <div class="acciones-superiores">
        <form action="" method="GET" class="buscador">
            <input type="text" name="buscar" placeholder="Buscar por nombre de subcategoría" value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">

            <select name="filtro_rol" class="filtro-rol">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id_categora'] ?>" <?= $categoria['id_categora'] == $filtroCategoria ? 'selected' : '' ?>><?= $categoria['nombre_cat'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Buscar</button>
        </form>

        <a href="modulos/subcategorias/form_agregar_subcategoria.php" class="boton-agregar">Agregar Subcategoría</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Subcategoría</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subcategorias as $subcategoria): ?>
                <tr>
                    <td><?= $subcategoria['nombre_sub_cat'] ?></td>
                    <td><?= $subcategoria['nombre_cat'] ?></td>
                    <td>
                        <a href="modulos/subcategorias/form_editar_subcategoria.php?id=<?= $subcategoria['id_sub_cat'] ?>" class="boton editar">Editar</a>
                        <a href="modulos/subcategorias/eliminar_subcategoria.php?id=<?= $subcategoria['id_sub_cat'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta subcategoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

</body>
</html>
