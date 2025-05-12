<?php
// Verificar si se ha pasado el ID de la categoría a eliminar
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de categoría no válido.");
}

// Conexión a la base de datos
include('../../conexion.php');

// Obtener el ID de la categoría
$id_categoria = $_GET['id'];

// Consultar si la categoría existe
$query = "SELECT * FROM categoria WHERE id_categora = ?";
$stmt = $base_de_datos->prepare($query);
$stmt->execute([$id_categoria]);
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si la categoría existe
if (!$categoria) {
    die("Categoría no encontrada.");
}

// Eliminar la categoría de la base de datos
$query = "DELETE FROM categoria WHERE id_categora = ?";
$stmt = $base_de_datos->prepare($query);
$stmt->execute([$id_categoria]);

// Redirigir al listado de categorías después de eliminar
header("Location: ../../categorias_admin.php");
exit;
?>
