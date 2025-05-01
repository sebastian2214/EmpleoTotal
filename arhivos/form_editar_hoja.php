<?php
include('../../conexion.php');

// Obtener el ID de la hoja de vida a editar
$id_hoja = $_GET['id_hojade_de_vida'];

// Consultar los datos de la hoja de vida
$consultaHoja = $base_de_datos->prepare("SELECT * FROM hojade_de_vida WHERE id_hojade_de_vida = ?");
$consultaHoja->execute([$id_hoja]);
$hoja = $consultaHoja->fetch(PDO::FETCH_ASSOC);

// Obtener la lista de usuarios
$consultaUsuarios = $base_de_datos->query("SELECT id_usuario, usuario FROM usuario WHERE rol_id_rol = 3");
$usuarios = $consultaUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Hoja de Vida - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
  <style>
    /* Estilo para el contenedor */
    .contenedor {
      width: 90%; /* Ocupa el 90% del ancho de la página */
      max-width: 1200px; /* Limita el ancho máximo a 1200px */
      margin: 0 auto; /* Centra el contenedor */
      padding: 20px; /* Espaciado interior */
    }

    /* Estilo para el formulario */
    .form_estilo {
      display: flex;
      flex-direction: column;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
    }
    
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        color: #333;
    }

    .form-group textarea:focus {
        border-color: #6C3483;
        outline: none;
    }
  </style>
</head>
<body>

<div class="contenedor">
  <div class="form_estilo">
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Hoja de Vida</h2>

    <form action="actualizar_hoja.php" method="POST">
      <input type="hidden" name="id_hojade_de_vida" value="<?= $hoja['id_hojade_de_vida'] ?>">
      
      <div class="form-group"><label>Nombre</label><input type="text" name="nombre" value="<?= htmlspecialchars($hoja['nombre']) ?>" required></div>
      <div class="form-group"><label>Apellido</label><input type="text" name="apellido" value="<?= htmlspecialchars($hoja['apellido']) ?>" required></div>
      <div class="form-group"><label>Dirección</label><input type="text" name="direccion" value="<?= htmlspecialchars($hoja['direccion']) ?>" required></div>
      <div class="form-group"><label>Teléfono</label><input type="text" name="telefono" value="<?= htmlspecialchars($hoja['telefono']) ?>" required></div>
      <div class="form-group"><label>Correo</label><input type="email" name="correo" value="<?= htmlspecialchars($hoja['correo']) ?>" required></div>
      
      <!-- Estado Civil con 5 opciones y el valor seleccionado previamente -->
      <div class="form-group">
        <label>Estado Civil</label>
        <select name="estado_civil" required>
          <option value="Soltero" <?= $hoja['estado_civil'] == 'Soltero' ? 'selected' : '' ?>>Soltero</option>
          <option value="Casado" <?= $hoja['estado_civil'] == 'Casado' ? 'selected' : '' ?>>Casado</option>
          <option value="Divorciado" <?= $hoja['estado_civil'] == 'Divorciado' ? 'selected' : '' ?>>Divorciado</option>
          <option value="Viudo" <?= $hoja['estado_civil'] == 'Viudo' ? 'selected' : '' ?>>Viudo</option>
          <option value="Otro" <?= $hoja['estado_civil'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
        </select>
      </div>

      <div class="form-group"><label>Fecha de Nacimiento</label><input type="date" name="fecha_nacimiento" value="<?= $hoja['fecha_nacimiento'] ?>" required></div>
      <div class="form-group"><label>Nacionalidad</label><input type="text" name="nacionalidad" value="<?= htmlspecialchars($hoja['nacionalidad']) ?>" required></div>
      <div class="form-group"><label>Descripción Sobre Ti</label><textarea name="descripcion_sobre_ti" required><?= htmlspecialchars($hoja['descripcion_sobre_ti']) ?></textarea></div>
      <div class="form-group"><label>Objetivo Profesional</label><textarea name="objetivo_profecional" required><?= htmlspecialchars($hoja['objetivo_profecional']) ?></textarea></div>
      <div class="form-group"><label>Idiomas</label><input type="text" name="idiomas" value="<?= htmlspecialchars($hoja['idiomas']) ?>" required></div>
      <div class="form-group"><label>Referencias</label><input type="text" name="referencias" value="<?= htmlspecialchars($hoja['referencias']) ?>" required></div>
      <div class="form-group"><label>Parentesco</label><input type="text" name="parentezco" value="<?= htmlspecialchars($hoja['parentezco']) ?>" required></div>
      <div class="form-group"><label>Número Referencia</label><input type="text" name="numero_referencia" value="<?= htmlspecialchars($hoja['numero_referencia']) ?>" required></div>
      <div class="form-group"><label>Intereses Personales</label><textarea name="intereses_personales" required><?= htmlspecialchars($hoja['intereses_personales']) ?></textarea></div>
      <div class="form-group"><label>Disponibilidad de Trabajo</label><input type="text" name="disponibilidad_trabajo" value="<?= htmlspecialchars($hoja['disponibilidad_trabajo']) ?>" required></div>

      <div class="form-group">
        <label for="usuario_id_usuario">Usuario</label>
        <select name="usuario_id_usuario" required>
          <option value="">Seleccione un usuario</option>
          <?php foreach ($usuarios as $usuario): ?>
            <option value="<?= $usuario['id_usuario'] ?>" <?= $hoja['usuario_id_usuario'] == $usuario['id_usuario'] ? 'selected' : '' ?>><?= htmlspecialchars($usuario['usuario']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Guardar Cambios</button>
    </form>
  </div>
</div>

</body>
</html>
