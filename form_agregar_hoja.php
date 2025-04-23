<?php
include('../../conexion.php');

// Obtener la lista de usuarios
$consultaUsuarios = $base_de_datos->query("SELECT id_usuario, usuario FROM usuario WHERE rol_id_rol = 3");
$usuarios = $consultaUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Hoja de Vida - EmpleoTotal</title>
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

    <h2>Agregar Hoja de Vida</h2>

    <form action="guardar_hoja.php" method="POST">
      <div class="form-group"><label>Nombre</label><input type="text" name="nombre" required></div>
      <div class="form-group"><label>Apellido</label><input type="text" name="apellido" required></div>
      <div class="form-group"><label>Dirección</label><input type="text" name="direccion" required></div>
      <div class="form-group"><label>Teléfono</label><input type="text" name="telefono" required></div>
      <div class="form-group"><label>Correo</label><input type="email" name="correo" required></div>
      
      <!-- Estado Civil con 5 opciones -->
      <div class="form-group">
        <label>Estado Civil</label>
        <select name="estado_civil" required>
          <option value="">Seleccione su estado civil</option>
          <option value="Soltero">Soltero</option>
          <option value="Casado">Casado</option>
          <option value="Divorciado">Divorciado</option>
          <option value="Viudo">Viudo</option>
          <option value="Otro">Otro</option>
        </select>
      </div>
      
      <div class="form-group"><label>Fecha de Nacimiento</label><input type="date" name="fecha_nacimiento" required></div>
      <div class="form-group"><label>Nacionalidad</label><input type="text" name="nacionalidad" required></div>
      <div class="form-group"><label>Descripción Sobre Ti</label><textarea name="descripcion_sobre_ti" required></textarea></div>
      <div class="form-group"><label>Objetivo Profesional</label><textarea name="objetivo_profecional" required></textarea></div>
      <div class="form-group"><label>Idiomas</label><input type="text" name="idiomas" required></div>
      <div class="form-group"><label>Referencias</label><input type="text" name="referencias" required></div>
      <div class="form-group"><label>Parentesco</label><input type="text" name="parentezco" required></div>
      <div class="form-group"><label>Número Referencia</label><input type="text" name="numero_referencia" required></div>
      <div class="form-group"><label>Intereses Personales</label><textarea name="intereses_personales" required></textarea></div>
      <div class="form-group"><label>Disponibilidad de Trabajo</label><input type="text" name="disponibilidad_trabajo" required></div>

      <div class="form-group">
        <label for="usuario_id_usuario">Usuario</label>
        <select name="usuario_id_usuario" required>
          <option value="">Seleccione un usuario</option>
          <?php foreach ($usuarios as $usuario): ?>
            <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['usuario']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Guardar Hoja de Vida</button>
    </form>
  </div>
</div>

</body>
</html>
