<?php
include_once "../../conexion.php";

// Obtener empresas (mostrar nombres)
$sqlEmpresas = "SELECT id_empresa, nombre_emp FROM empresas";
$stmtEmpresas = $base_de_datos->prepare($sqlEmpresas);
$stmtEmpresas->execute();
$empresas = $stmtEmpresas->fetchAll(PDO::FETCH_ASSOC);

// Obtener subcategorías (mostrar nombres)
$sqlSubCat = "SELECT id_sub_cat, nombre_sub_cat FROM sub_cat";
$stmtSubCat = $base_de_datos->prepare($sqlSubCat);
$stmtSubCat->execute();
$subcategorias = $stmtSubCat->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Oferta de Empleo</title>
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

<div class="container">
  <div class="formulario">
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Agregar Oferta de Empleo</h2>

    <form action="guardar_oferta.php" method="POST" enctype="multipart/form-data">
      <div class="form-grid">
        <div class="form-group">
          <label for="titulo_emp">Título</label>
          <input type="text" id="titulo_emp" name="titulo_emp" required>
        </div>

        <div class="form-group">
          <label for="empresas_id">Empresa</label>
          <select id="empresas_id" name="empresas_id" required>
            <option value="">Seleccione una empresa</option>
            <?php foreach ($empresas as $empresa): ?>
              <option value="<?= $empresa['id_empresa'] ?>"><?= htmlspecialchars($empresa['nombre_emp']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label for="requisitos">Requisitos</label>
          <textarea id="requisitos" name="requisitos" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label for="ubicacion">Ubicación</label>
          <input type="text" id="ubicacion" name="ubicacion" required>
        </div>

        <div class="form-group">
          <label for="salario">Salario</label>
          <input type="text" id="salario" name="salario" required>
        </div>

        <div class="form-group">
          <label for="oferta_empleocol">Imagen</label>
          <input type="file" id="oferta_empleocol" name="oferta_empleocol" accept="image/*" required>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="text" id="telefono" name="telefono" required>
        </div>

        <div class="form-group">
          <label for="correo">Correo</label>
          <input type="email" id="correo" name="correo" required>
        </div>

        <div class="form-group">
          <label for="link_test">Link del test</label>
          <input type="test" id="link_test" name="link_test" required>
        </div>

        <div class="form-group">
          <label for="sub_cat_id_sub_cat">Subcategoría</label>
          <select id="sub_cat_id_sub_cat" name="sub_cat_id_sub_cat" required>
            <option value="">Seleccione una subcategoría</option>
            <?php foreach ($subcategorias as $subcat): ?>
              <option value="<?= $subcat['id_sub_cat'] ?>"><?= htmlspecialchars($subcat['nombre_sub_cat']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <button type="submit" class="btn-agregar">Agregar Oferta</button>
    </form>
  </div>
</div>

</body>
</html>
