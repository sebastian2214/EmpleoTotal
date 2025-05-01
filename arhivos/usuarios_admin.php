<?php
include_once "conexion.php";

$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";
$filtroRol = isset($_GET['filtro_rol']) ? trim($_GET['filtro_rol']) : "";

$sql = "SELECT u.id_usuario, u.usuario, u.correo, u.contrasena, u.rol_id_rol, r.nombre_rol
        FROM usuario u
        JOIN rol r ON u.rol_id_rol = r.id_rol
        WHERE (u.usuario LIKE :busqueda OR u.correo LIKE :busqueda)";

if ($filtroRol !== "") {
    $sql .= " AND u.rol_id_rol = :rol";
}

$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':busqueda', "%$busqueda%");

if ($filtroRol !== "") {
    $stmt->bindValue(':rol', $filtroRol, PDO::PARAM_INT);
}

$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios - EmpleoTotal</title>
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
  <h1>Gestión de Usuarios</h1>

  <div class="acciones-superiores">
  <form action="" method="GET" class="buscador">
  <input type="text" name="buscar" placeholder="Buscar por nombre o correo" value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
  
  <select name="filtro_rol" class="filtro-rol">
  <option value="">Todos los roles</option>
  <option value="1">Admin</option>
  <option value="2">Empresa</option>
  <option value="3">Usuario</option>
</select>

  
  <button type="submit">Buscar</button>
</form>
    <!--<form method="GET" class="formulario-busqueda">
        <input type="text" name="buscar" placeholder="Buscar usuario o correo..." value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit">Buscar</button>
      </form>-->
    <a href="modulos/usuarios/form_agregar_usuario.php" class="boton-agregar">Agregar Usuario</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Contraseña</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($usuarios as $usuario): ?>
        <tr>
          <td><?= $usuario['usuario'] ?></td>
          <td><?= $usuario['correo'] ?></td>
          <td><?= $usuario['contrasena'] ?></td>
          <td><?= $usuario['nombre_rol'] ?></td>
          <td>
            <a href="modulos/usuarios/form_editar_usuario.php?id=<?= $usuario['id_usuario'] ?>" class="boton editar">Editar</a>
            <a href="modulos/usuarios/eliminar_usuario.php?id=<?= $usuario['id_usuario'] ?>" class="boton eliminar" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

</body>
</html>
