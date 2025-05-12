<?php
include_once "conexion.php";

// Búsqueda por institución o título
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

// Consulta con JOIN para mostrar el nombre en lugar del ID
$sql = "SELECT e.idEstudios, e.intitucion, e.titulo, e.fecha_inicio, e.fecha_fin, h.nombre AS nombre_hoja_vida
        FROM estudios e
        JOIN hojade_de_vida h ON e.hojade_de_vida_id_hojade_de_vida = h.id_hojade_de_vida
        WHERE e.intitucion LIKE :busqueda OR e.titulo LIKE :busqueda";

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");
$stmt->execute();
$estudios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Estudios - EmpleoTotal</title>
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
  <h1>Gestión de Estudios</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar por institución o título" value="<?= htmlspecialchars($busqueda) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="modulos/estudios/form_agregar_estudio.php" class="boton-agregar">Agregar Estudio</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Institución</th>
        <th>Título</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Hoja de Vida</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($estudios as $estudio): ?>
        <tr>
          <td><?= htmlspecialchars($estudio['intitucion']) ?></td>
          <td><?= htmlspecialchars($estudio['titulo']) ?></td>
          <td><?= htmlspecialchars($estudio['fecha_inicio']) ?></td>
          <td><?= htmlspecialchars($estudio['fecha_fin']) ?></td>
          <td><?= htmlspecialchars($estudio['nombre_hoja_vida']) ?></td>
          <td>
            <a href="modulos/estudios/form_editar_estudio.php?id=<?= $estudio['idEstudios'] ?>" class="boton editar">Editar</a>
            <a href="modulos/estudios/eliminar_estudio.php?id=<?= $estudio['idEstudios'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar este estudio?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

</body>
</html>
