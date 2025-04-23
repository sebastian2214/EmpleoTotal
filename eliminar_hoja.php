<?php
include_once "../../conexion.php"; // Asegúrate de que la ruta sea correcta

// Verifica que se haya pasado un ID de hoja de vida
if (isset($_GET['id_hojade_de_vida']) && !empty($_GET['id_hojade_de_vida'])) {
    $id_hojade_de_vida = $_GET['id_hojade_de_vida'];

    // Prepara la consulta para eliminar la hoja de vida por ID
    $sql = "DELETE FROM hojade_de_vida WHERE id_hojade_de_vida = :id_hojade_de_vida";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(':id_hojade_de_vida', $id_hojade_de_vida, PDO::PARAM_INT);

    try {
        // Ejecuta la consulta
        $stmt->execute();

        // Redirige a la página de listado de hojas de vida después de eliminar
        header("Location: ../../hojas_vida_admin.php");
        exit;
    } catch (Exception $e) {
        echo "Error al eliminar la hoja de vida: " . $e->getMessage();
    }
} else {
    echo "No se especificó el ID de la hoja de vida a eliminar.";
}
?>
