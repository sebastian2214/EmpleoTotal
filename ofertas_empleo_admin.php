<?php
include_once "conexion.php";

// Búsqueda y filtrado
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";

$sql = "SELECT oe.id_oferta_empleo, oe.titulo_emp, oe.descripcion, oe.ubicacion, oe.salario, oe.telefono, oe.correo, oe.link_test, oe.oferta_empleocol, sc.nombre_sub_cat, e.nombre_emp
        FROM oferta_empleo oe
        LEFT JOIN sub_cat sc ON oe.sub_cat_id_sub_cat = sc.id_sub_cat
        LEFT JOIN empresas e ON oe.empresas_id = e.id_empresa
        WHERE oe.titulo_emp LIKE :busqueda OR oe.descripcion LIKE :busqueda";

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");
$stmt->execute();
$ofertas = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ofertas de Empleo - EmpleoTotal</title>
  <link rel="stylesheet" href="estilos/crud_estilos.css">
  <style>
    .oferta-img {
      width: 100px;
      height: auto;
    }
  </style>
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
  <h1>Ofertas de Empleo</h1>

  <div class="acciones-superiores">
    <form action="" method="GET" class="buscador">
      <input type="text" name="buscar" placeholder="Buscar por título o descripción" value="<?= htmlspecialchars($busqueda) ?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="modulos/ofertas/form_agregar_oferta.php" class="boton-agregar">Agregar Oferta</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Descripción</th>
        <th>Empresa</th>
        <th>Ubicación</th>
        <th>Salario</th>
        <th>Imagen</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Link Test</th>
        <th>Subcategoría</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ofertas as $oferta) { ?>
        <tr>
          <td><?php echo $oferta->titulo_emp; ?></td>
          <td><?php echo $oferta->descripcion ?></td>
          <td><?php echo $oferta->nombre_emp ?></td> 
          <td><?php echo $oferta->ubicacion ?></td>
          <td><?php echo '$' . number_format($oferta->salario, 0, ',', '.'); ?></td>
          <td>
            <?php if ($oferta->oferta_empleocol): ?>
                <img src="<?php echo $oferta->oferta_empleocol; ?>" alt="Imagen de la oferta" style="width: 100px; height: auto;">
            <?php else: ?>
                No hay imagen
            <?php endif; ?>
          </td>
          <td><?php echo $oferta->telefono ?></td>
          <td><?php echo $oferta->correo ?></td>
          <td>
            <?php if ($oferta->link_test): ?>
                <a href="<?php echo htmlspecialchars($oferta->link_test); ?>" target="_blank">Ver Test</a>
            <?php else: ?>
                Sin enlace
            <?php endif; ?>
          </td>
          <td><?php echo $oferta->nombre_sub_cat ?></td>
          <td>
            <a href="modulos/ofertas/form_editar_oferta.php?id=<?= $oferta->id_oferta_empleo ?>" class="boton editar">Editar</a><p>
            <a href="modulos/ofertas/eliminar_oferta.php?id=<?= $oferta->id_oferta_empleo ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta oferta?')">Eliminar</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</main>

</body>
</html>
