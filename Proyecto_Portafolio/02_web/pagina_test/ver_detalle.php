<?php
// Iniciar sesión
session_start();

// Verificar si se recibió el ID del postulado
if (!isset($_GET['id_postulado']) || !is_numeric($_GET['id_postulado'])) {
    echo "No se especificó o el ID del postulado es inválido.";
    exit;
}

// Incluir la conexión a la base de datos
include_once "conexion.php";

// Obtener los datos del postulado
try {
    $id_postulado = intval($_GET['id_postulado']);
    $query = "
        SELECT id_hojade_de_vida, nombre, apellido, direccion, telefono, correo, estado_civil, 
               fecha_nacimiento, nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, 
               referencias, parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo, 
               usuario_id_usuario
        FROM hojade_de_vida
        WHERE id_hojade_de_vida = :id_postulado";
    $sentencia = $base_de_datos->prepare($query);
    $sentencia->bindParam(':id_postulado', $id_postulado, PDO::PARAM_INT);
    $sentencia->execute();
    $postulado = $sentencia->fetch(PDO::FETCH_OBJ);

    // Verificar si el postulado existe
    if (!$postulado) {
        echo "No se encontró información para el ID proporcionado.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error al recuperar los datos: " . htmlspecialchars($e->getMessage());
    exit;
}

// Obtener los datos del test asociado
$test = null;
try {
    $query_test = "
        SELECT id_test, resultado, imagen_test, usuario_id, oferta_id
        FROM test_oferta
        WHERE usuario_id = :usuario_id";
    $sentencia_test = $base_de_datos->prepare($query_test);
    $sentencia_test->bindParam(':usuario_id', $postulado->usuario_id_usuario, PDO::PARAM_INT);
    $sentencia_test->execute();
    $test = $sentencia_test->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error al recuperar los datos del test: " . htmlspecialchars($e->getMessage());
    exit;
}

// Verificar si el test fue encontrado y si tiene imagen
$ruta_imagen = null; // Inicializamos como null
if ($test && !empty($test->imagen_test)) {
    $ruta_imagen = htmlspecialchars($test->imagen_test); // Aseguramos el contenido
    if (!file_exists($ruta_imagen)) {
        $ruta_imagen = null; // Si no existe la imagen, dejamos null
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Postulado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

       /* General */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Fondo claro */
    color: #212529; /* Texto oscuro */
    margin: 0;
    padding: 0;
}

/* Header */
/* Header estilizado */
header {
    background: linear-gradient(90deg, #000000 0%, #4d07ff 100%);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header .logo {
    max-height: 70px;
}

header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #dccfff;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

header .btn-lila {
    background-color: #6f42c1;
    color: #dccfff;
    border: 2px solid #3f2874;
    padding: 8px 20px;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.3s ease;
}

header .btn-lila:hover {
    background-color: #6645cc;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
}


        .container {
            max-width: 960px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table {
            margin-bottom: 30px;
        }
        .btn-back {
            margin-top: 20px;
        }
        h1, h3 {
            color: #5a5a5a;
        }
        img {
            max-width: 300px;
            max-height: 200px;
        }
    </style>
</head>
<body>
<header>
    <div class="container d-flex justify-content-between align-items-center py-3 px-4">
        <div class="d-flex align-items-center">
            <img src="./img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo me-3">
            <h1 class="text-white mb-0">Detalles del Postulado</h1>
        </div>
        <button class="btn btn-lila" onclick="location.href='./mostrar_datos.php'">Volver</button>
    </div>
</header>


<div class="container mt-5">
    <!-- Información de la hoja de vida -->
    <h3>Información</h3>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr><th>Nombre</th><td><?php echo htmlspecialchars($postulado->nombre); ?></td></tr>
            <tr><th>Apellido</th><td><?php echo htmlspecialchars($postulado->apellido); ?></td></tr>
            <tr><th>Dirección</th><td><?php echo htmlspecialchars($postulado->direccion); ?></td></tr>
            <tr><th>Teléfono</th><td><?php echo htmlspecialchars($postulado->telefono); ?></td></tr>
            <tr><th>Correo</th><td><?php echo htmlspecialchars($postulado->correo); ?></td></tr>
            <tr><th>Estado Civil</th><td><?php echo htmlspecialchars($postulado->estado_civil); ?></td></tr>
            <tr><th>Fecha de Nacimiento</th><td><?php echo htmlspecialchars($postulado->fecha_nacimiento); ?></td></tr>
            <tr><th>Nacionalidad</th><td><?php echo htmlspecialchars($postulado->nacionalidad); ?></td></tr>
            <tr><th>Descripción Sobre Ti</th><td><?php echo htmlspecialchars($postulado->descripcion_sobre_ti); ?></td></tr>
            <tr><th>Objetivo Profesional</th><td><?php echo htmlspecialchars($postulado->objetivo_profecional); ?></td></tr>
            <tr><th>Idiomas</th><td><?php echo htmlspecialchars($postulado->idiomas); ?></td></tr>
            <tr><th>Referencias</th><td><?php echo htmlspecialchars($postulado->referencias); ?></td></tr>
            <tr><th>Parentesco</th><td><?php echo htmlspecialchars($postulado->parentezco); ?></td></tr>
            <tr><th>Número de Referencia</th><td><?php echo htmlspecialchars($postulado->numero_referencia); ?></td></tr>
            <tr><th>Intereses Personales</th><td><?php echo htmlspecialchars($postulado->intereses_personales); ?></td></tr>
            <tr><th>Disponibilidad de Trabajo</th><td><?php echo htmlspecialchars($postulado->disponibilidad_trabajo); ?></td></tr>
        </tbody>
    </table>

   <!-- Información del test -->
<?php if ($test): ?>
    <h3>Puntuacion test</h3>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr><th>Resultado del Test</th><td><?php echo htmlspecialchars($test->resultado); ?></td></tr>
            <tr>
                <th>Imagen del Test</th>
                <td>
                    <?php if ($ruta_imagen): ?>
                        <img src="<?php echo $ruta_imagen; ?>" alt="Imagen del Test" class="img-fluid">
                    <?php else: ?>
                        <p class="text-danger">La imagen no está disponible.</p>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-warning">No se encontró información del test para este usuario.</p>
<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
