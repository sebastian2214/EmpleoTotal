<?php
include_once "../../conexion.php";

// Verificamos que venga el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID de la oferta de empleo a editar.";
    exit;
}

$id_oferta_empleo = $_GET["id"];



// Obtener los datos de la oferta de empleo
$sql = "SELECT * FROM oferta_empleo WHERE id_oferta_empleo = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $id_oferta_empleo, PDO::PARAM_INT);
$stmt->execute();
$oferta = $stmt->fetch(PDO::FETCH_OBJ);

// Verificamos que exista
if (!$oferta) {
    echo "Oferta de empleo no encontrada.";
    exit;
}

// Obtener empresas (mostrar nombres)
$sqlEmpresas = "SELECT id_empresa, nombre_emp FROM empresas";
$stmtEmpresas = $base_de_datos->prepare($sqlEmpresas);
$stmtEmpresas->execute();
$empresas = $stmtEmpresas->fetchAll(PDO::FETCH_OBJ);

// Obtener subcategorías (mostrar nombres)
$sqlSubCat = "SELECT id_sub_cat, nombre_sub_cat FROM sub_cat";
$stmtSubCat = $base_de_datos->prepare($sqlSubCat);
$stmtSubCat->execute();
$subcategorias = $stmtSubCat->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Oferta de Empleo - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
  <style>
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
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

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

  <!-- Formulario de edición de oferta de empleo -->
  <div class="formulario">
    
    <!-- Logo en la esquina derecha dentro del formulario -->
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Oferta de Empleo</h2>

    <form action="actualizar_oferta.php" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
      <input type="hidden" name="id_oferta_empleo" value="<?php echo $oferta->id_oferta_empleo ?>">

      <!-- Título -->
      <div class="form-group">
        <label for="titulo_emp">Título</label>
        <input type="text" id="titulo_emp" name="titulo_emp" required value="<?php echo htmlspecialchars ($oferta->titulo_emp); ?>">
      </div>

      <!-- Empresa -->
      <div class="form-group">
        <label for="empresas_id">Empresa</label>
        <select id="empresas_id" name="empresas_id" required>
        <?php foreach ($empresas as $empresa): ?>
          <option value="<?php echo htmlspecialchars($empresa->id_empresa); ?>" 
          <?php echo ($empresa->id_empresa == $oferta->empresas_id) ? 'selected' : ''; ?>>
          <?php echo htmlspecialchars($empresa->nombre_emp); ?>
        </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Descripción -->
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars ($oferta->descripcion); ?></textarea>
      </div>

      <!-- Requisitos -->
      <div class="form-group">
        <label for="requisitos">Requisitos</label>
        <textarea id="requisitos" name="requisitos" rows="3" required><?php echo htmlspecialchars ($oferta->requisitos); ?></textarea>
      </div>

      <!-- Ubicación -->
      <div class="form-group">
        <label for="ubicacion">Ubicación</label>
        <input type="text" id="ubicacion" name="ubicacion" required value="<?php echo htmlspecialchars ($oferta->ubicacion); ?>">
      </div>

      <!-- Salario -->
      <div class="form-group">
        <label for="salario">Salario</label>
        <input type="text" id="salario" name="salario" required value="<?php echo htmlspecialchars ($oferta->salario); ?>">
      </div>

      <!-- Imagen (mostrar la imagen actual si existe) -->
      <div class="form-group">
      <label for="oferta_empleocol">Imagen actual:</label><br>
      <label for="oferta_empleocol">Cambiar Imagen (Opcional)</label>
      <input type="file" id="oferta_empleocol" name="oferta_empleocol" accept="image/*">
                <?php if (!empty($oferta->oferta_empleocol)): ?>
                    <img src="../../<?php echo htmlspecialchars($oferta->oferta_empleocol); ?>" alt="Imagen actual" style="max-width: 200px;">
                <?php else: ?>
                    <p>No hay imagen disponible</p>
        <?php endif; ?>
      </div>

      <!-- Teléfono -->
      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" required value="<?php echo htmlspecialchars ($oferta->telefono); ?>">
      </div>

      <!-- Correo -->
      <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" required value="<?php echo htmlspecialchars ($oferta->correo); ?>">
      </div>

      <!-- Link del Test -->
      <div class="form-group">
        <label for="link_test">Link del test</label>
        <input type="text" id="link_test" name="link_test" required value="<?php echo htmlspecialchars ($oferta->link_test); ?>">
      </div>

      <!-- Subcategoría -->
      <div class="form-group">
        <label for="sub_cat_id_sub_cat">Subcategoría</label>
        <select id="sub_cat_id_sub_cat" name="sub_cat_id_sub_cat" required>
        <?php foreach ($subcategorias as $subcat): ?>
          <option value="<?php echo htmlspecialchars($subcat->id_sub_cat); ?>"
          <?php echo ($subcat->id_sub_cat == $oferta->sub_cat_id_sub_cat) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($subcat->nombre_sub_cat); ?>
        </option>
          <?php endforeach; ?>
        </select>
      </div><p></p>

      <button type="submit" class="btn-agregar">Actualizar Oferta</button>
    </form>
    </div>
  </div>

</div>

</body>
</html>
