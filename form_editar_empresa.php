<?php
include_once "../../conexion.php";

// Verificamos que venga el ID
if (!isset($_GET["id"])) {
    echo "No se especificó el ID de la empresa a editar.";
    exit;
}

$id_empresa = $_GET["id"];

// Obtener datos de la empresa con el nombre del usuario asociado
$sql = "SELECT * FROM empresas WHERE id_empresa = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $id_empresa, PDO::PARAM_INT);
$stmt->execute();
$empresa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$empresa) {
    echo "Empresa no encontrada.";
    exit;
}

// Obtener lista de usuarios
$sqlUsuarios = "SELECT id_usuario, usuario FROM usuario WHERE rol_id_rol = 2";
$stmtUsuarios = $base_de_datos->query($sqlUsuarios);
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Empresa - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
  <style>
    .container {
      max-width: 1400px;
      margin: auto;
      padding: 20px;
    }

    .formulario {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 30px;
    }

    .logo-minimal {
      text-align: right;
    }

    .logo-minimal img {
      width: 100px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #6C3483;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px 30px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      margin-bottom: 6px;
    }

    input, select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .btn-agregar {
      background-color: #6C3483;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 30px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .btn-agregar:hover {
      background-color: #5a2d6d;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="formulario">
    
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Empresa</h2>

    <form action="actualizar_empresa.php" method="POST">
      <input type="hidden" name="id_empresa" value="<?= htmlspecialchars($empresa['id_empresa']) ?>">

      <div class="form-grid">

        <div class="form-group">
          <label for="nombre_emp">Nombre Empresa</label>
          <input type="text" name="nombre_emp" value="<?= htmlspecialchars($empresa['nombre_emp']) ?>" required>
        </div>

        <div class="form-group">
          <label for="industria">Industria</label>
          <input type="text" name="industria" value="<?= htmlspecialchars($empresa['industria']) ?>">
        </div>

        <div class="form-group">
          <label for="ubicacion">Ubicación</label>
          <input type="text" name="ubicacion" value="<?= htmlspecialchars($empresa['ubicacion']) ?>">
        </div>

        <div class="form-group">
          <label for="tamano_emp">Tamaño Empresa</label>
          <input type="text" name="tamano_emp" value="<?= htmlspecialchars($empresa['tamano_emp']) ?>">
        </div>

        <div class="form-group">
          <label for="descripcion_emp">Descripción</label>
          <input type="text" name="descripcion_emp" value="<?= htmlspecialchars($empresa['descripcion_emp']) ?>">
        </div>

        <div class="form-group">
          <label for="contacto">Contacto</label>
          <input type="text" name="contacto" value="<?= htmlspecialchars($empresa['contacto']) ?>">
        </div>

        <div class="form-group">
          <label for="correo">Correo</label>
          <input type="email" name="correo" value="<?= htmlspecialchars($empresa['correo']) ?>">
        </div>

        <div class="form-group">
          <label for="sitio_web_of">Sitio Web</label>
          <input type="text" name="sitio_web_of" value="<?= htmlspecialchars($empresa['sitio_web_of']) ?>">
        </div>

        <div class="form-group">
          <label for="antecedentes">Antecedentes</label>
          <input type="text" name="antecedentes" value="<?= htmlspecialchars($empresa['antecedentes']) ?>">
        </div>

        <div class="form-group">
          <label for="mision">Misión</label>
          <input type="text" name="mision" value="<?= htmlspecialchars($empresa['mision']) ?>">
        </div>

        <div class="form-group">
          <label for="vision">Visión</label>
          <input type="text" name="vision" value="<?= htmlspecialchars($empresa['vision']) ?>">
        </div>

        <div class="form-group">
          <label for="regionales">Regionales</label>
          <input type="text" name="regionales" value="<?= htmlspecialchars($empresa['regionales']) ?>">
        </div>

        <div class="form-group">
          <label for="hitos_significativos">Hitos Significativos</label>
          <input type="text" name="hitos_significativos" value="<?= htmlspecialchars($empresa['hitos_significativos']) ?>">
        </div>

        <div class="form-group">
          <label for="innovaciones_recientes">Innovaciones Recientes</label>
          <input type="text" name="innovaciones_recientes" value="<?= htmlspecialchars($empresa['innovaciones_recientes']) ?>">
        </div>

        <div class="form-group">
          <label for="beneficios_empleados">Beneficios a Empleados</label>
          <input type="text" name="beneficios_empleados" value="<?= htmlspecialchars($empresa['beneficios_empleados']) ?>">
        </div>

        <div class="form-group">
          <label for="usuario_id_usuario">Usuario Asociado</label>
          <select name="usuario_id_usuario" required>
            <option value="">Seleccione un usuario</option>
            <?php foreach ($usuarios as $usuario): ?>
              <option value="<?= $usuario['id_usuario'] ?>" 
                <?= $usuario['id_usuario'] == $empresa['usuario_id_usuario'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($usuario['usuario']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

      </div>

      <button type="submit" class="btn-agregar">Actualizar Empresa</button>
    </form>
  </div>
</div>

</body>
</html>
