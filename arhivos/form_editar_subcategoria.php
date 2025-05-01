<?php
include_once "../../conexion.php";

// Verificamos que venga el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID de la subcategoría a editar.";
    exit;
}

$id_sub_categoria = $_GET["id"];

// Obtener los datos de la subcategoría
$sql = "SELECT * FROM sub_cat WHERE id_sub_cat = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $id_sub_categoria, PDO::PARAM_INT);
$stmt->execute();
$subcategoria = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificamos que exista
if (!$subcategoria) {
    echo "Subcategoría no encontrada.";
    exit;
}

// Consulta de categorías para el filtro
$queryCategorias = "SELECT * FROM categoria";
$stmtCategorias = $base_de_datos->prepare($queryCategorias);
$stmtCategorias->execute();
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Subcategoría - EmpleoTotal</title>
  <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

  <!-- Formulario de edición de subcategoría -->
  <div class="formulario">
    
    <!-- Logo en la esquina derecha dentro del formulario -->
    <div class="logo-minimal">
      <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
    </div>

    <h2>Editar Subcategoría</h2>

    <form action="actualizar_subcategoria.php" method="POST">
      <input type="hidden" name="id_sub_cat" value="<?= htmlspecialchars($subcategoria['id_sub_cat']) ?>">

      <div class="form-group">
        <label for="nombre_sub_cat">Nombre de la Subcategoría</label>
        <input type="text" id="nombre_sub_cat" name="nombre_sub_cat" required value="<?= htmlspecialchars($subcategoria['nombre_sub_cat']) ?>">
      </div>

      <div class="form-group">
        <label for="categoria">Categoría</label>
        <select id="categoria" name="categoria_id_categora" required>
          <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id_categora'] ?>" <?= $subcategoria['categoria_id_categora'] == $categoria['id_categora'] ? 'selected' : '' ?>><?= $categoria['nombre_cat'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn-agregar">Actualizar Subcategoría</button>
    </form>
  </div>

</div>

</body>
</html>
