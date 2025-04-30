<?php
include_once "../../conexion.php"; // Asegúrate de que la ruta sea correcta

// Verifica que se haya pasado un ID de usuario
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Prepara la consulta para eliminar el usuario por ID
    $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    try {
        // Ejecuta la consulta
        $stmt->execute();

        // Redirige a la página de usuarios después de eliminar
        header("Location: ../../usuarios_admin.php");
        exit;
    } catch (Exception $e) {
        echo "Error al eliminar el usuario: " . $e->getMessage();
    }
} else {
    echo "No se especificó el ID del usuario a eliminar.";
}
?>
