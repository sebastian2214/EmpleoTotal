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

// Obtener detalles de la hoja de vida desde la base de datos
$stmt_cv = $pdo->prepare("SELECT * FROM hojade_de_vida WHERE usuario_id_usuario = :id_usuario");
$stmt_cv->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_cv->execute();
$hoja_de_vida = $stmt_cv->fetch(PDO::FETCH_ASSOC);

if (!$hoja_de_vida) {
    die("Hoja de vida no encontrada.");
}

// Configurar la descarga del archivo de texto
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="hoja_de_vida.txt"');

// Generar el contenido del archivo de texto
foreach ($hoja_de_vida as $key => $value) {
    echo ucfirst(str_replace('_', ' ', $key)) . ": " . $value . "\n";
}
?>
