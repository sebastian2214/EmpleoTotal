<?php
// Configuración de conexión a la base de datos
$host = 'localhost';
$db = 'empleototal';
$user = 'root';
$password = '';
$charset = 'utf8';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió un ID de usuario
if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
    die("ID de usuario no proporcionado.");
}

$id_usuario = $_GET['id_usuario'];

try {
    // Obtener la hoja de vida asociada al usuario
    $stmt_hoja = $pdo->prepare("
        SELECT id_hojade_de_vida, nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo
        FROM hojade_de_vida 
        WHERE usuario_id_usuario = :id_usuario
    ");
    $stmt_hoja->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_hoja->execute();
    $hoja_de_vida = $stmt_hoja->fetch(PDO::FETCH_ASSOC);

    if (!$hoja_de_vida) {
        die("No se encontró una hoja de vida asociada al usuario.");
    }

    // Obtener los estudios asociados a la hoja de vida
    $stmt_estudios = $pdo->prepare("
        SELECT intitucion, titulo, fecha_inicio, fecha_fin 
        FROM estudios 
        WHERE hojade_de_vida_id_hojade_de_vida = :id_hoja
    ");
    $stmt_estudios->bindParam(':id_hoja', $hoja_de_vida['id_hojade_de_vida'], PDO::PARAM_INT);
    $stmt_estudios->execute();
    $estudios = $stmt_estudios->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de Vida y Estudios</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-primary {
            background-color: #6f42c1 !important; 
        }
        .btn-primary {
            background-color: #6f42c1 !important; 
            border-color: #6f42c1 !important; 
        }
        .btn-primary:hover {
            background-color: #5a32a3 !important; 
            border-color: #5a32a3 !important;
        }
        .content {
            margin-top: 120px; /* Ajusta según la altura de tu encabezado */
        }
    </style>
</head>
<body class="bg-light">
<header class="bg-dark text-white py-3 fixed-top">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h4">Hoja de Vida y Estudios</h1>
        <button class="btn btn-primary" onclick="location.href='inicio.php'">Volver a Inicio</button>
    </div>
</header>
<div class="container content">
    <!-- Sección de Hoja de Vida -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white text-center">
            <h3>Hoja de Vida</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($hoja_de_vida['nombre']); ?></p>
            <p><strong>Apellido:</strong> <?php echo htmlspecialchars($hoja_de_vida['apellido']); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($hoja_de_vida['direccion']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($hoja_de_vida['telefono']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($hoja_de_vida['correo']); ?></p>
            <p><strong>Estado Civil:</strong> <?php echo htmlspecialchars($hoja_de_vida['estado_civil']); ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($hoja_de_vida['fecha_nacimiento']); ?></p>
            <p><strong>Nacionalidad:</strong> <?php echo htmlspecialchars($hoja_de_vida['nacionalidad']); ?></p>
            <p><strong>Descripción Sobre Ti:</strong> <?php echo htmlspecialchars($hoja_de_vida['descripcion_sobre_ti']); ?></p>
            <p><strong>Objetivo Profesional:</strong> <?php echo htmlspecialchars($hoja_de_vida['objetivo_profecional']); ?></p>
            <p><strong>Idiomas:</strong> <?php echo htmlspecialchars($hoja_de_vida['idiomas']); ?></p>
            <p><strong>Referencias:</strong> <?php echo htmlspecialchars($hoja_de_vida['referencias']); ?></p>
            <p><strong>Parentesco:</strong> <?php echo htmlspecialchars($hoja_de_vida['parentezco']); ?></p>
            <p><strong>Número de Referencia:</strong> <?php echo htmlspecialchars($hoja_de_vida['numero_referencia']); ?></p>
            <p><strong>Intereses Personales:</strong> <?php echo htmlspecialchars($hoja_de_vida['intereses_personales']); ?></p>
            <p><strong>Disponibilidad de Trabajo:</strong> <?php echo htmlspecialchars($hoja_de_vida['disponibilidad_trabajo']); ?></p>
        </div>
    </div>

    <!-- Sección de Estudios -->
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Estudios Asociados</h3>
        </div>
        <div class="card-body">
            <?php if (count($estudios) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($estudios as $estudio): ?>
                        <li class="list-group-item">
                            <p><strong>Institución:</strong> <?php echo htmlspecialchars($estudio['intitucion']); ?></p>
                            <p><strong>Título:</strong> <?php echo htmlspecialchars($estudio['titulo']); ?></p>
                            <p><strong>Fecha Inicio:</strong> <?php echo htmlspecialchars($estudio['fecha_inicio']); ?></p>
                            <p><strong>Fecha Fin:</strong> <?php echo htmlspecialchars($estudio['fecha_fin']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No hay estudios asociados para esta hoja de vida.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<center>
<a href="generar_pdf.php?id_usuario=<?php echo $id_usuario; ?>" class="btn btn-success">Descargar en PDF</a>
            </center>
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Tu Empresa. Todos los derechos reservados.</p>
</footer>
<!-- Enlace a Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
