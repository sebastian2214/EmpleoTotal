<?php
include_once "../../conexion.php";

// Verificamos que se haya pasado el ID de la calificación por GET
if (!isset($_GET['id'])) {
    echo "No se especificó el ID de la calificación a eliminar.";
    exit;
}

$idcalificaciones = $_GET['id'];

// Eliminamos la calificación de la base de datos
$sql = "DELETE FROM calificaciones WHERE idcalificaciones = :idcalificaciones";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":idcalificaciones", $idcalificaciones, PDO::PARAM_INT);

if ($stmt->execute()) {
    // Si la eliminación es exitosa, redirigimos al listado de calificaciones
    header("Location: ../../calificaciones_admin.php");
    exit;
} else {
    echo "Error al eliminar la calificación.";
}
?>
