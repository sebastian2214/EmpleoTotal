<?php
session_start();
include_once "conexion.php";

// Verificar si existe el ID de la oferta de empleo
if (!isset($_GET["id"])) {
    exit("¡No existe un ID especificado!");
}

$id_oferta_empleo = $_GET["id"];

// Obtener los datos de la oferta a editar
try {
    $query = "SELECT * FROM oferta_empleo WHERE id_oferta_empleo = ?";
    $sentencia = $base_de_datos->prepare($query);
    $sentencia->execute([$id_oferta_empleo]);
    $oferta = $sentencia->fetch(PDO::FETCH_OBJ);

    if (!$oferta) {
        exit("¡No existe una oferta con ese ID!");
    }
} catch (PDOException $e) {
    exit("Error al recuperar la oferta: " . $e->getMessage());
}

// Obtener todas las subcategorías para llenar el desplegable
$query_sub_cat = "SELECT * FROM sub_cat";
$sentencia_sub_cat = $base_de_datos->prepare($query_sub_cat);
$sentencia_sub_cat->execute();
$subcategorias = $sentencia_sub_cat->fetchAll(PDO::FETCH_OBJ);

// Procesar la edición del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_emp = $_POST["titulo_emp"];
    $descripcion = $_POST["descripcion"];
    $requisitos = $_POST["requisitos"];
    $ubicacion = $_POST["ubicacion"];
    $salario = $_POST["salario"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $sub_cat_id_sub_cat = $_POST["sub_cat_id_sub_cat"];
    $link_test = $_POST["link_test"];

    // Manejo de la imagen subida
    $imagen = $oferta->oferta_empleocol; // Mantener la imagen actual si no se sube una nueva
    if (isset($_FILES["oferta_empleocol"]) && $_FILES["oferta_empleocol"]["error"] == 0) {
        $imagen = "uploads/" . $_FILES["oferta_empleocol"]["name"];
        move_uploaded_file($_FILES["oferta_empleocol"]["tmp_name"], $imagen);
    }

    // Actualizar los datos en la base de datos
    try {
        $query = "UPDATE oferta_empleo SET 
                    titulo_emp = ?, 
                    descripcion = ?, 
                    requisitos = ?, 
                    ubicacion = ?, 
                    salario = ?, 
                    telefono = ?, 
                    correo = ?, 
                    sub_cat_id_sub_cat = ?, 
                    oferta_empleocol = ?, 
                    link_test = ? 
                  WHERE id_oferta_empleo = ?";
        $sentencia = $base_de_datos->prepare($query);
        $sentencia->execute([$titulo_emp, $descripcion, $requisitos, $ubicacion, $salario, $telefono, $correo, $sub_cat_id_sub_cat, $imagen, $link_test, $id_oferta_empleo]);

        // Redirigir al archivo mostrar_datos.php después de actualizar
        header("Location: mostrar_datos.php");
        exit(); // Asegurarse de que no se siga ejecutando el script después de la redirección
    } catch (PDOException $e) {
        exit("Error al actualizar la oferta: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oferta de Empleo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/editar-oferta.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Editar Oferta de Empleo</h2>
        <form method="POST" action="editar.php?id=<?php echo $oferta->id_oferta_empleo; ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_oferta_empleo" value="<?php echo $oferta->id_oferta_empleo; ?>">

            <div class="mb-3">
                <label for="titulo_emp" class="form-label">Título:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="titulo_emp" 
                    value="<?php echo htmlspecialchars($oferta->titulo_emp); ?>" 
                    required 
                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                    title="Solo se permiten letras y espacios">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea 
                    class="form-control" 
                    name="descripcion" 
                    required 
                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                    title="Solo se permiten letras y espacios"><?php echo htmlspecialchars($oferta->descripcion); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos:</label>
                <textarea 
                    class="form-control" 
                    name="requisitos" 
                    required 
                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                    title="Solo se permiten letras y espacios"><?php echo htmlspecialchars($oferta->requisitos); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="ubicacion" 
                    value="<?php echo htmlspecialchars($oferta->ubicacion); ?>" 
                    required 
                    title="Solo se permiten letras y espacios">
            </div>

            <div class="mb-3">
                <label for="salario" class="form-label">Salario:</label>
                <input 
                    type="number" 
                    class="form-control" 
                    name="salario" 
                    value="<?php echo htmlspecialchars($oferta->salario); ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="link_test" class="form-label">Enlace al Test:</label>
                <input 
                    type="url" 
                    class="form-control" 
                    name="link_test" 
                    value="<?php echo htmlspecialchars($oferta->link_test); ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="oferta_empleocol" class="form-label">Imagen actual:</label><br>
                <?php if (!empty($oferta->oferta_empleocol)): ?>
                    <img src="<?php echo htmlspecialchars($oferta->oferta_empleocol); ?>" alt="Imagen actual" style="max-width: 200px;">
                <?php else: ?>
                    <p>No hay imagen disponible</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="oferta_empleocol" class="form-label">Cambiar imagen (opcional):</label>
                <input 
                    type="file" 
                    class="form-control" 
                    id="oferta_empleocol" 
                    name="oferta_empleocol" 
                    accept="image/*">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input 
                    type="number" 
                    class="form-control" 
                    name="telefono" 
                    value="<?php echo htmlspecialchars($oferta->telefono); ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input 
                    type="email" 
                    class="form-control" 
                    name="correo" 
                    value="<?php echo htmlspecialchars($oferta->correo); ?>" 
                    required>
            </div>

            <div class="mb-3">
                <label for="sub_cat_id_sub_cat" class="form-label">Subcategoría:</label>
                <select class="form-control" name="sub_cat_id_sub_cat" required>
                    <?php foreach ($subcategorias as $subcat): ?>
                        <option value="<?php echo htmlspecialchars($subcat->id_sub_cat); ?>" <?php echo ($subcat->id_sub_cat == $oferta->sub_cat_id_sub_cat) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($subcat->nombre_sub_cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
