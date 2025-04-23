<?php
include('../../conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar la notificación
    $query = "DELETE FROM notificaciones WHERE idnotificaciones = ?";
    $stmt = $base_de_datos->prepare($query);
    $resultado = $stmt->execute([$id]);

    if ($resultado) {
        header("Location: ../../notificaciones_admin.php");
        exit;
    } else {
        echo "Error al eliminar la notificación.";
    }
} else {
    echo "ID de notificación no proporcionado.";
}
