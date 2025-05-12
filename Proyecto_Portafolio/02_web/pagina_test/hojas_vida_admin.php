<?php
include_once "conexion.php";

$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

$sql = "SELECT h.*, u.usuario 
        FROM hojade_de_vida h
        JOIN usuario u ON h.usuario_id_usuario = u.id_usuario
        WHERE h.nombre LIKE :busqueda OR h.apellido LIKE :busqueda OR u.usuario LIKE :busqueda";

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");
$stmt->execute();
$hojasVida = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Hojas de Vida - EmpleoTotal</title>
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
  <h1>Gestión de Hojas de Vida</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar por nombre, apellido o usuario" value="<?= htmlspecialchars($busqueda) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="modulos/hojas_vida/form_agregar_hoja.php" class="boton-agregar">Agregar Hoja de Vida</a>
  </div>

  <div class="tabla-scroll">
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Fecha Nacimiento</th>
          <th>Nacionalidad</th>
          <th>Disponibilidad</th>
          <th>Usuario</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($hojasVida as $hoja): ?>
          <tr>
            <td><?= htmlspecialchars($hoja['nombre']) ?></td>
            <td><?= htmlspecialchars($hoja['apellido']) ?></td>
            <td><?= htmlspecialchars($hoja['direccion']) ?></td>
            <td><?= htmlspecialchars($hoja['telefono']) ?></td>
            <td><?= htmlspecialchars($hoja['correo']) ?></td>
            <td><?= htmlspecialchars($hoja['fecha_nacimiento']) ?></td>
            <td><?= htmlspecialchars($hoja['nacionalidad']) ?></td>
            <td><?= htmlspecialchars($hoja['disponibilidad_trabajo']) ?></td>
            <td><?= htmlspecialchars($hoja['usuario']) ?></td>
            <td>
              <a href="modulos/hojas_vida/form_editar_hoja.php?id_hojade_de_vida=<?= $hoja['id_hojade_de_vida'] ?>" class="boton editar">Editar</a><p>
              <a href="modulos/hojas_vida/eliminar_hoja.php?id_hojade_de_vida=<?= $hoja['id_hojade_de_vida'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta hoja de vida?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>

</body>
</html>
