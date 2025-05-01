<?php
include_once "../../conexion.php";

// Verificamos que venga el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID del estudio a editar.";
    exit;
}

$idEstudios = $_GET["id"];

// Obtener los datos del estudio
$sql = "SELECT * FROM estudios WHERE idEstudios = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $idEstudios, PDO::PARAM_INT);
$stmt->execute();
$estudio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$estudio) {
    echo "Estudio no encontrado.";
    exit;
}

// Obtener las hojas de vida para el select
$sqlHojas = "SELECT id_hojade_de_vida, nombre FROM hojade_de_vida";
$hojas_stmt = $base_de_datos->query($sqlHojas);
$hojas = $hojas_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Estudio - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<div class="container">
  <div class="formulario">

    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Estudio</h2>

    <form action="actualizar_estudio.php" method="POST">
      <input type="hidden" name="idEstudios" value="<?= htmlspecialchars($estudio['idEstudios']) ?>">

      <div class="form-group">
        <label for="intitucion">Institución</label>
        <input type="text" id="intitucion" name="intitucion" required value="<?= htmlspecialchars($estudio['intitucion']) ?>">
      </div>

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required value="<?= htmlspecialchars($estudio['titulo']) ?>">
      </div>

      <div class="form-group">
        <label for="fecha_inicio">Fecha de Inicio</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required value="<?= htmlspecialchars($estudio['fecha_inicio']) ?>">
      </div>

      <div class="form-group">
        <label for="fecha_fin">Fecha de Finalización</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required value="<?= htmlspecialchars($estudio['fecha_fin']) ?>">
      </div>

      <div class="form-group">
        <label for="hojade_de_vida_id_hojade_de_vida">Hoja de Vida</label>
        <select id="hojade_de_vida_id_hojade_de_vida" name="hojade_de_vida_id_hojade_de_vida" required>
          <option value="">Seleccione una hoja de vida</option>
          <?php foreach ($hojas as $hoja): ?>
            <option value="<?= $hoja['id_hojade_de_vida'] ?>" 
              <?= $hoja['id_hojade_de_vida'] == $estudio['hojade_de_vida_id_hojade_de_vida'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($hoja['nombre']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Actualizar Estudio</button>
    </form>
  </div>
</div>

</body>
</html>
