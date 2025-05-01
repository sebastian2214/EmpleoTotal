<?php
session_start(); // Iniciar sesión

require 'conexion.php';
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

$key = "mi_clave_secreta"; // Clave secreta para verificar el token

// Verificar si ya hay una sesión activa
if (!isset($_SESSION['id_usuario']) && isset($_COOKIE['token'])) {
    $jwt = $_COOKIE['token'];

    try {
        // Decodificar el token
        $decoded = JWT::decode($jwt, new \Firebase\JWT\Key($key, 'HS256'));
        $decoded_array = (array) $decoded;

        // Restaurar datos del usuario en la sesión
        $_SESSION['id_usuario'] = $decoded_array['user_id'];
        $_SESSION['usuario'] = $decoded_array['usuario'];
        $_SESSION['rol_id_rol'] = $decoded_array['rol'];
    } catch (Exception $e) {
        // Si el token es inválido o ha expirado, redirigir al inicio de sesión
        header('Location: Inicio_Sesion.php');
        exit();
    }
}

// Si no hay sesión activa ni token, redirigir al inicio de sesión
if (!isset($_SESSION['id_usuario'])) {
    header('Location: Inicio_Sesion.php');
    exit();
}

// Recuperar datos del usuario
$id_usuario = $_SESSION['id_usuario'];
$stmt = $base_de_datos->prepare("SELECT usuario FROM usuario WHERE id_usuario = :id");
$stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Error: Usuario no encontrado.";
    exit();
}

// Consultar ofertas de empleo
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT id_oferta_empleo, titulo_emp, ubicacion, descripcion, oferta_empleocol 
        FROM oferta_empleo 
        WHERE titulo_emp LIKE :searchTerm";
$stmt = $base_de_datos->prepare($sql);
$searchWildcard = "%" . $searchTerm . "%";
$stmt->bindParam(':searchTerm', $searchWildcard, PDO::PARAM_STR);
$stmt->execute();
$empleos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Llamativo</title>
    <link rel="stylesheet" href="./inicios.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="container">
        <img src="./imagenes/WhatsApp_Image_2024-05-19_at_7.50.52_PM-removebg-preview.png" alt="Logo" class="logo">
        <div class="user-icons">
            <button class="btn-lila" onclick="location.href='./mensaje.php'">Chat</button>
            <button class="btn-lila position-relative" onclick="location.href='./notificacion.php'">
                Notificaciones
                <span id="notification-badge" class="badge badge-danger position-absolute top-0 start-100 translate-middle">0</span>
            </button>
            <button class="user-icon-btn" onclick="toggleSidebar()">
                <i class="fa fa-bars user-icon"></i>
            </button>
        </div>
    </div>
</header>

<nav id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
    <div class="sidebar-content">
        <img src="<?php echo htmlspecialchars($usuario['imagen_perfil'] ?? 'imagenes/user.jfif'); ?>" alt="Imagen de Perfil" class="profile-image">
        <h2><?php echo htmlspecialchars($usuario['usuario']); ?></h2>
        <a href="./empleos.php">Empleos</a>
        <a href="detalle_usuario.php?id_usuario=<?php echo htmlspecialchars($id_usuario); ?>">Ver Usuario</a>
        <a href="./logout.php"><button class="btn-cerrar-sesion">Cerrar Sesión</button></a>
    </div>
</nav>

<div id="overlay" class="overlay" onclick="closeSidebar()"></div>

<section class="banner">
    <div class="content-banner">
        <p>Encuentra tu próximo empleo</p>
        <h2>100% Confiable <br />Muchas Categorías</h2>
    </div>
</section>

<section class="container top-categories">
    <h1 class="heading-1">Mejores Categorías</h1>
    <div class="container-categories">
        <div class="card-category category-moca">
            <p>Ingeniería Sistemas</p>
            <a href="./empleos.php" class="btn-ver-mas">Ver más</a>
        </div>
        <div class="card-category category-expreso">
            <p>Contaduría</p>
            <a href="./empleos.php" class="btn-ver-mas">Ver más</a>
        </div>
        <div class="card-category category-capuchino">
            <p>Transporte terrestre</p>
            <a href="./empleos.php" class="btn-ver-mas">Ver más</a>
        </div>
    </div>
</section>

<section class="container my-5 ofertas-container">
    <?php foreach ($empleos as $row): ?>
        <div class="card">
            <img src="<?php echo htmlspecialchars($row['oferta_empleocol'] ?? 'imagenes/LogoTotal.png'); ?>" class="card-img-top" alt="Imagen de oferta">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($row['titulo_emp']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($row['ubicacion']); ?></small></p>
                <a href="./detalleempleo.php?id=<?php echo htmlspecialchars($row['id_oferta_empleo']); ?>" class="btn btn-primary">Más detalles</a>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<footer>
    <div class="container text-center">
        <p>&copy; 2024 Tu Empresa. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").style.width = "250px";
        document.getElementById("overlay").style.display = "block";
    }
    function closeSidebar() {
        document.getElementById("sidebar").style.width = "0";
        document.getElementById("overlay").style.display = "none";
    }
</script>
</body>
</html>
