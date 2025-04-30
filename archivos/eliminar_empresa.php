<?php
include_once "../../conexion.php";

// Verificar si se recibió el ID por GET
if (!isset($_GET["id"])) {
    echo "No se especificó el ID de la empresa a eliminar.";
    exit;
}

$id_empresa = $_GET["id"];

// Preparar y ejecutar la consulta para eliminar la empresa
$sql = "DELETE FROM empresas WHERE id_empresa = :id";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindParam(":id", $id_empresa, PDO::PARAM_INT);
$stmt->execute();

// Redirigir al listado de empresas
header("Location: ../../empresas_admin.php");
exit;
?>
