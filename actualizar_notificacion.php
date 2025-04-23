<?php
include('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['idnotificaciones'];
    $contenido = trim($_POST['contenido']);
    $fecha_envio = $_POST['fecha_envio'];
    $usuario_id = $_POST['usuario_id_usuario'];

    // Validar que no estén vacíos
    if (empty($contenido) || empty($fecha_envio) || empty($usuario_id)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Actualizar notificación
    $query = "UPDATE notificaciones 
              SET contenido = ?, fecha_envio = ?, usuario_id_usuario = ? 
              WHERE idnotificaciones = ?";
    $stmt = $base_de_datos->prepare($query);
    $resultado = $stmt->execute([$contenido, $fecha_envio, $usuario_id, $id]);

    if ($resultado) {
        header("Location: ../../notificaciones_admin.php");
        exit;
    } else {
        echo "Error al actualizar la notificación.";
    }
} else {
    header("Location: ../../notificaciones_admin.php");
    exit;
}
