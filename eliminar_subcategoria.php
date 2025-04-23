<?php
include_once "../../conexion.php"; // Asegúrate de que la ruta sea correcta

// Verifica que se haya pasado un ID de subcategoría
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_sub_cat = $_GET['id'];

    // Prepara la consulta para eliminar la subcategoría por ID
    $sql = "DELETE FROM sub_cat WHERE id_sub_cat = :id_sub_cat";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(':id_sub_cat', $id_sub_cat, PDO::PARAM_INT);

    try {
        // Ejecuta la consulta
        $stmt->execute();

        // Redirige a la página de subcategorías después de eliminar
        header("Location: ../../subcategorias_admin.php");
        exit;
    } catch (Exception $e) {
        echo "Error al eliminar la subcategoría: " . $e->getMessage();
    }
} else {
    echo "No se especificó el ID de la subcategoría a eliminar.";
}
?>
