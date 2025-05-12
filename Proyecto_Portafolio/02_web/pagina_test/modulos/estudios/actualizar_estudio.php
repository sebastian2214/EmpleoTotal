<?php
include_once "../../conexion.php";

// Verificamos que los datos estén completos
if (
    !isset($_POST["idEstudios"]) ||
    !isset($_POST["intitucion"]) ||
    !isset($_POST["titulo"]) ||
    !isset($_POST["fecha_inicio"]) ||
    !isset($_POST["fecha_fin"]) ||
    !isset($_POST["hojade_de_vida_id_hojade_de_vida"])
) {
    echo "Faltan datos por enviar.";
    exit;
}

$idEstudios = $_POST["idEstudios"];
$intitucion = $_POST["intitucion"];
$titulo = $_POST["titulo"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$hoja_vida_id = $_POST["hojade_de_vida_id_hojade_de_vida"];

try {
    // Actualizar el registro
    $sql = "UPDATE estudios 
            SET intitucion = :intitucion, 
                titulo = :titulo, 
                fecha_inicio = :fecha_inicio, 
                fecha_fin = :fecha_fin, 
                hojade_de_vida_id_hojade_de_vida = :hoja_vida_id 
            WHERE idEstudios = :idEstudios";

    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(":intitucion", $intitucion);
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":fecha_inicio", $fecha_inicio);
    $stmt->bindParam(":fecha_fin", $fecha_fin);
    $stmt->bindParam(":hoja_vida_id", $hoja_vida_id);
    $stmt->bindParam(":idEstudios", $idEstudios, PDO::PARAM_INT);

    $stmt->execute();

    // Redirigir al listado de estudios (ajusta el nombre según tu estructura)
    header("Location: ../../estudios_admin.php");
    exit;

} catch (Exception $e) {
    echo "Error al actualizar el estudio: " . $e->getMessage();
}
