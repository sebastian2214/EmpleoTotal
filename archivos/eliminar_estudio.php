<?php
include_once "../../conexion.php";

// Verificamos que venga el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID del estudio a eliminar.";
    exit;
}

$idEstudios = $_GET["id"];

try {
    // Preparar y ejecutar la eliminación
    $sql = "DELETE FROM estudios WHERE idEstudios = :idEstudios";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(":idEstudios", $idEstudios, PDO::PARAM_INT);
    $stmt->execute();

    // Redirigir al listado de estudios
    header("Location: ../../estudios_admin.php");
    exit;

} catch (Exception $e) {
    echo "Error al eliminar el estudio: " . $e->getMessage();
}
