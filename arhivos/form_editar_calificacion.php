<?php
include_once "../../conexion.php";

// Verificamos que venga el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID de la calificación a editar.";
    exit;
}

$id_calificacion = $_GET["id"];

// Obtener los datos de la calificación
$sql = "SELECT * FROM calificaciones WHERE idcalificaciones = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $id_calificacion, PDO::PARAM_INT);
$stmt->execute();
$calificacion = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificamos que exista
if (!$calificacion) {
    echo "Calificación no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Calificación - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
  <style>
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

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

  <!-- Formulario de edición de calificación -->
  <div class="formulario">
    
    <!-- Logo en la esquina derecha dentro del formulario -->
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Calificación</h2>

    <form action="actualizar_calificacion.php" method="POST">
      <input type="hidden" name="idcalificaciones" value="<?= htmlspecialchars($calificacion['idcalificaciones']) ?>">

      <div class="form-group">
        <label for="calificacion">Calificación</label>
        <input type="number" id="calificacion" name="calificacion" required value="<?= htmlspecialchars($calificacion['calificacion']) ?>" min="1" max="5">
      </div>

      <div class="form-group">
        <label for="comentario">Comentario</label>
        <textarea id="comentario" name="comentario" required><?= htmlspecialchars($calificacion['comentario']) ?></textarea>
      </div>

      <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" required value="<?= htmlspecialchars($calificacion['fecha']) ?>">
      </div>

      <div class="form-group">
        <label for="oferta_empleo_id_oferta_empleo">Oferta de Empleo</label>
        <select id="oferta_empleo_id_oferta_empleo" name="oferta_empleo_id_oferta_empleo" required>
          <!-- Aquí deberías rellenar el select con las ofertas de empleo desde la base de datos -->
          <?php
          $query_ofertas = "SELECT id_oferta_empleo, titulo_emp FROM oferta_empleo";
          $stmt_ofertas = $base_de_datos->prepare($query_ofertas);
          $stmt_ofertas->execute();
          $ofertas = $stmt_ofertas->fetchAll(PDO::FETCH_ASSOC);
          foreach ($ofertas as $oferta) {
              $selected = ($calificacion['oferta_empleo_id_oferta_empleo'] == $oferta['id_oferta_empleo']) ? 'selected' : '';
              echo "<option value='" . $oferta['id_oferta_empleo'] . "' $selected>" . htmlspecialchars($oferta['titulo_emp']) . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="usuario_id_usuario">Usuario</label>
        <select id="usuario_id_usuario" name="usuario_id_usuario" required>
          <!-- Aquí deberías rellenar el select con los usuarios desde la base de datos -->
          <?php
          $query_usuarios = "SELECT id_usuario, usuario FROM usuario WHERE rol_id_rol = 3";
          $stmt_usuarios = $base_de_datos->prepare($query_usuarios);
          $stmt_usuarios->execute();
          $usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);
          foreach ($usuarios as $usuario) {
              $selected = ($calificacion['usuario_id_usuario'] == $usuario['id_usuario']) ? 'selected' : '';
              echo "<option value='" . $usuario['id_usuario'] . "' $selected>" . htmlspecialchars($usuario['usuario']) . "</option>";
          }
          ?>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Actualizar Calificación</button>
    </form>
  </div>

</div>

</body>
</html>
