<?php
// Incluir la conexión
include('../../conexion.php');

// Obtener todas las hojas de vida para el select
$sql = "SELECT id_hojade_de_vida, nombre FROM hojade_de_vida";
$stmt = $base_de_datos->prepare($sql);
$stmt->execute();
$hojas_vida = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Estudio - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<div class="container">
  <div class="formulario">
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Agregar Estudio</h2>
    <form action="guardar_estudio.php" method="POST">
      <div class="form-group">
        <label for="intitucion">Institución</label>
        <input type="text" id="intitucion" name="intitucion" required>
      </div>

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required>
      </div>

      <div class="form-group">
        <label for="fecha_inicio">Fecha de Inicio</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
      </div>

      <div class="form-group">
        <label for="fecha_fin">Fecha de Fin</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
      </div>

      <div class="form-group">
        <label for="hoja_vida">Hoja de Vida</label>
        <select id="hoja_vida" name="hojade_de_vida_id_hojade_de_vida" required>
          <option value="">Seleccione una hoja de vida</option>
          <?php foreach ($hojas_vida as $hv): ?>
            <option value="<?= $hv['id_hojade_de_vida'] ?>"><?= htmlspecialchars($hv['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Agregar Estudio</button>
    </form>
  </div>
</div>

</body>
</html>
