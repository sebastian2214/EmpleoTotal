<?php
include_once "conexion.php";

$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";
$filtroCalificacion = isset($_GET['filtro_calificacion']) ? trim($_GET['filtro_calificacion']) : "";

$sql = "SELECT 
            c.idcalificaciones, 
            c.calificacion, 
            c.comentario, 
            c.fecha, 
            u.usuario AS nombre_usuario, 
            o.titulo_emp AS nombre_oferta
        FROM calificaciones c
        JOIN usuario u ON c.usuario_id_usuario = u.id_usuario
        JOIN oferta_empleo o ON c.oferta_empleo_id_oferta_empleo = o.id_oferta_empleo
        WHERE (u.usuario LIKE :busqueda OR o.titulo_emp LIKE :busqueda)";

if ($filtroCalificacion !== "") {
    $sql .= " AND c.calificacion = :calificacion";
}

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");

if ($filtroCalificacion !== "") {
    $stmt->bindValue(':calificacion', $filtroCalificacion, PDO::PARAM_INT);
}

$stmt->execute();
$calificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Calificaciones - EmpleoTotal</title>
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
  <h1>Gestión de Calificaciones</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar usuario u oferta" value="<?= htmlspecialchars($busqueda) ?>">

      <select name="filtro_calificacion" class="filtro-rol">
        <option value="">Todas las calificaciones</option>
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <option value="<?= $i ?>" <?= ($filtroCalificacion == $i) ? "selected" : "" ?>><?= $i ?> estrella<?= $i > 1 ? "s" : "" ?></option>
        <?php endfor; ?>
      </select>

      <button type="submit">Buscar</button>
    </form>

    <a href="modulos/calificaciones/form_agregar_calificacion.php" class="boton-agregar">Agregar Calificación</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Oferta</th>
        <th>Calificación</th>
        <th>Comentario</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($calificaciones as $calificacion): ?>
        <tr>
          <td><?= htmlspecialchars($calificacion['nombre_usuario']) ?></td>
          <td><?= htmlspecialchars($calificacion['nombre_oferta']) ?></td>
          <td><?= htmlspecialchars($calificacion['calificacion']) ?></td>
          <td><?= htmlspecialchars($calificacion['comentario']) ?></td>
          <td><?= htmlspecialchars($calificacion['fecha']) ?></td>
          <td>
            <a href="modulos/calificaciones/form_editar_calificacion.php?id=<?= $calificacion['idcalificaciones'] ?>" class="boton editar">Editar</a>
            <a href="modulos/calificaciones/eliminar_calificacion.php?id=<?= $calificacion['idcalificaciones'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta calificación?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

</body>
</html>
