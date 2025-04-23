<?php
include_once "../../conexion.php";

// Verificamos que venga el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID del usuario a editar.";
    exit;
}

$id_usuario = $_GET["id"];

// Obtener los datos del usuario
$sql = "SELECT * FROM usuario WHERE id_usuario = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificamos que exista
if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

  <!-- Formulario de edición de usuario -->
  <div class="formulario">
    
    <!-- Logo en la esquina derecha dentro del formulario -->
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Usuario</h2>

    <form action="actualizar_usuario.php" method="POST">
      <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

      <div class="form-group">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" required value="<?= htmlspecialchars($usuario['usuario']) ?>">
      </div>

      <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" required value="<?= htmlspecialchars($usuario['correo']) ?>">
      </div>

      <div class="form-group">
        <label for="contrasena">Contraseña (encriptada)</label>
        <input type="text" id="contrasena" value="<?= htmlspecialchars($usuario['contrasena']) ?>" disabled>
      </div>

      <div class="form-group">
        <label for="rol">Rol</label>
        <select id="rol" name="rol_id_rol" required>
          <option value="1" <?= $usuario['rol_id_rol'] == 1 ? 'selected' : '' ?>>Admin</option>
          <option value="2" <?= $usuario['rol_id_rol'] == 2 ? 'selected' : '' ?>>Empresa</option>
          <option value="3" <?= $usuario['rol_id_rol'] == 3 ? 'selected' : '' ?>>Usuario</option>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Actualizar Usuario</button>
    </form>
  </div>

</div>

</body>
</html>
