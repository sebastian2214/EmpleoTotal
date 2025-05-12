<?php
include_once "conexion.php"; 

if (!isset($_GET["id"])) {
    exit("¡No existe un ID especificado!");
}

$id = $_GET["id"];

try {
    // Obtener los datos de la oferta de empleo para editarlos
    $sentencia = $base_de_datos->prepare("SELECT * FROM oferta_empleo WHERE id_oferta_empleo = ?;");
    $sentencia->execute([$id]);
    $oferta = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($oferta === false) {
        exit("¡No existe alguna oferta con ese ID!");
    }
} catch (PDOException $e) {
    exit("Error al recuperar la oferta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oferta de Empleo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Editar Oferta de Empleo</h2>
        <form method="post" action="guardarDatosEditados.php" enctype="multipart/form-data">
            <input type="hidden" name="id_oferta_empleo" value="<?php echo $oferta->id_oferta_empleo; ?>">

            <div class="mb-3">
                <label for="titulo_emp" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo_emp" value="<?php echo $oferta->titulo_emp; ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" name="descripcion" required><?php echo $oferta->descripcion; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos:</label>
                <textarea class="form-control" name="requisitos" required><?php echo $oferta->requisitos; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación:</label>
                <input type="text" class="form-control" name="ubicacion" value="<?php echo $oferta->ubicacion; ?>" required>
            </div>

            <div class="mb-3">
                <label for="salario" class="form-label">Salario:</label>
                <input type="number" class="form-control" name="salario" value="<?php echo $oferta->salario; ?>" required>
            </div>

            <!-- Mostrar la imagen actual si existe -->
            <div class="mb-3">
                <label for="oferta_empleocol" class="form-label">Imagen actual:</label><br>
                <?php if (!empty($oferta->oferta_empleocol)): ?>
                    <img src="<?php echo $oferta->oferta_empleocol; ?>" alt="Imagen actual" style="max-width: 200px;">
                <?php else: ?>
                    <p>No hay imagen disponible</p>
                <?php endif; ?>
            </div>

            <!-- Permitir subir una nueva imagen -->
            <div class="mb-3">
                <label for="oferta_empleocol" class="form-label">Cambiar imagen (opcional):</label>
                <input type="file" class="form-control" id="oferta_empleocol" name="oferta_empleocol" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="number" class="form-control" name="telefono" value="<?php echo $oferta->telefono; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" value="<?php echo $oferta->correo; ?>" required>
            </div>

            <div class="mb-3">
                <label for="sub_cat_id_sub_cat" class="form-label">ID Subcategoría:</label>
                <input type="number" class="form-control" name="sub_cat_id_sub_cat" value="<?php echo $oferta->sub_cat_id_sub_cat; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
