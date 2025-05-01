<?php
include_once "conexion.php";

$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

// Consulta que une la tabla notificaciones con usuario para mostrar el nombre de usuario
$sql = "SELECT n.idnotificaciones, n.contenido, n.fecha_envio, u.usuario 
        FROM notificaciones n
        JOIN usuario u ON n.usuario_id_usuario = u.id_usuario
        WHERE n.contenido LIKE :busqueda OR u.usuario LIKE :busqueda";

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");
$stmt->execute();
$notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Notificaciones - EmpleoTotal</title>
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
  <h1>Gestión de Notificaciones</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar por contenido o usuario" value="<?= htmlspecialchars($busqueda) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="modulos/notificaciones/form_agregar_notificacion.php" class="boton-agregar">Agregar Notificación</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Contenido</th>
        <th>Fecha de Envío</th>
        <th>Usuario</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($notificaciones as $noti): ?>
        <tr>
          <td><?= htmlspecialchars($noti['contenido']) ?></td>
          <td><?= htmlspecialchars($noti['fecha_envio']) ?></td>
          <td><?= htmlspecialchars($noti['usuario']) ?></td>
          <td>
            <a href="modulos/notificaciones/form_editar_notificacion.php?id=<?= $noti['idnotificaciones'] ?>" class="boton editar">Editar</a>
            <a href="modulos/notificaciones/eliminar_notificacion.php?id=<?= $noti['idnotificaciones'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta notificación?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

</body>
</html>
