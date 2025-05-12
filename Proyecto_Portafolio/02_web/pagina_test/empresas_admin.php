<?php
include_once "conexion.php";

// Buscar empresas por nombre o industria
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

// Consulta con JOIN para mostrar el nombre del usuario en lugar del ID
$sql = "SELECT e.*, u.usuario AS nombre_usuario
        FROM empresas e
        JOIN usuario u ON e.usuario_id_usuario = u.id_usuario
        WHERE e.nombre_emp LIKE :busqueda OR e.industria LIKE :busqueda";

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");
$stmt->execute();
$empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Empresas - EmpleoTotal</title>
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
  <h1>Gestión de Empresas</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar por nombre o industria" value="<?= htmlspecialchars($busqueda) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="modulos/empresas/form_agregar_empresa.php" class="boton-agregar">Agregar Empresa</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Industria</th>
        <th>Ubicación</th>
        <th>Tamaño</th>
        <th>Contacto</th>
        <th>Correo</th>
        <th>Sitio Web</th>
        <th>Usuario Asociado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($empresas as $empresa): ?>
        <tr>
          <td><?= htmlspecialchars($empresa['nombre_emp']) ?></td>
          <td><?= htmlspecialchars($empresa['industria']) ?></td>
          <td><?= htmlspecialchars($empresa['ubicacion']) ?></td>
          <td><?= htmlspecialchars($empresa['tamano_emp']) ?></td>
          <td><?= htmlspecialchars($empresa['contacto']) ?></td>
          <td><?= htmlspecialchars($empresa['correo']) ?></td>
          <td><?= htmlspecialchars($empresa['sitio_web_of']) ?></td>
          <td><?= htmlspecialchars($empresa['nombre_usuario']) ?></td>
          <td>
            <a href="modulos/empresas/form_editar_empresa.php?id=<?= $empresa['id_empresa'] ?>" class="boton editar">Editar</a><p>
            <a href="modulos/empresas/eliminar_empresa.php?id=<?= $empresa['id_empresa'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta empresa?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

</body>
</html>
