<?php
include_once "conexion.php";

// Búsqueda y filtrado
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

$sql = "SELECT * FROM categoria WHERE nombre_cat LIKE :busqueda";

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar si la consulta ha devuelto resultados
if (!$categorias) {
    echo "No se encontraron categorías.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Categorías - EmpleoTotal</title>
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
  <h1>Categorías</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar por nombre" value="<?= htmlspecialchars($busqueda) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="modulos/categorias/form_agregar_categoria.php" class="boton-agregar">Agregar Categoría</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categorias as $categoria): ?>
        <tr>
          <td><?= htmlspecialchars($categoria['nombre_cat']) ?></td>
          <td>
            <a href="modulos/categorias/form_editar_categoria.php?id=<?= $categoria['id_categora'] ?>" class="boton editar">Editar</a>
            <a href="modulos/categorias/eliminar_categoria.php?id=<?= $categoria['id_categora'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

</body>
</html>
