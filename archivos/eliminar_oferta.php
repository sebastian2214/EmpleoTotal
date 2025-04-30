<?php
include_once "../../conexion.php";

// Verificar si el ID de la oferta de empleo está presente en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de la oferta de empleo desde la URL
    $id_oferta_empleo = $_GET['id'];

    // Preparar la consulta SQL para eliminar la oferta
    $sql = "DELETE FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(':id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);

    // Ejecutar la consulta de eliminación
    if ($stmt->execute()) {
        // Redirigir a la lista de ofertas después de la eliminación
        header("Location: ../../ofertas_empleo_admin.php");
        exit();
    } else {
        // Si ocurre un error al ejecutar la consulta
        echo "Error al eliminar la oferta de empleo.";
    }
} else {
    // Si no se proporciona un ID de oferta de empleo
    echo "ID de oferta de empleo no especificado.";
}
?>
