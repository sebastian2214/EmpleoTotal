<?php
// Iniciar la sesión
session_start();
include_once "conexion.php"; 

// Obtener el ID de la oferta de empleo de la URL
$id_oferta_empleo = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_oferta_empleo === 0) {
    echo "Oferta de empleo no encontrada.";
    exit();
}

// Consulta para obtener la oferta de empleo por su ID
try {
    $sentencia = $base_de_datos->prepare("SELECT * FROM oferta_empleo WHERE id_oferta_empleo = :id");
    $sentencia->bindParam(':id', $id_oferta_empleo, PDO::PARAM_INT);
    $sentencia->execute();
    $oferta = $sentencia->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error al recuperar los datos: " . $e->getMessage();
    exit();
}

if (!$oferta) {
    echo "Oferta de empleo no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Oferta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/detalle_oferta.css">
</head>
<body>
<header>
    <div class="container">
        <img src="../img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
        <button class="btn-lila" onclick="location.href='../notificacionem.php'">Volver</button>
    </div>
</header>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Detalles de la Oferta de Empleo</h2>

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <?php if ($oferta->oferta_empleocol): ?>
                    <img src="<?php echo $oferta->oferta_empleocol; ?>" class="img-fluid rounded-start" alt="Imagen de la oferta">
                <?php else: ?>
                    <img src="../img/default_image.png" class="img-fluid rounded-start" alt="Sin imagen">
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $oferta->titulo_emp; ?></h5>
                    <p class="card-text"><strong>Descripción:</strong> <?php echo $oferta->descripcion; ?></p>
                    <p class="card-text"><strong>Requisitos:</strong> <?php echo $oferta->requisitos; ?></p>
                    <p class="card-text"><strong>Ubicación:</strong> <?php echo $oferta->ubicacion; ?></p>
                    <p class="card-text"><strong>Salario:</strong> <?php echo $oferta->salario; ?></p>
                    <p class="card-text"><strong>Teléfono:</strong> <?php echo $oferta->telefono; ?></p>
                    <p class="card-text"><strong>Correo:</strong> <?php echo $oferta->correo; ?></p>
                    <p class="card-text"><strong>Sub Categoría:</strong> <?php echo $oferta->sub_cat_id_sub_cat; ?></p>
                </div>
            </div>
        </div>
    </div>

    <a href="mostrar_datos.php" class="btn btn-primary">Volver a Ofertas</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
