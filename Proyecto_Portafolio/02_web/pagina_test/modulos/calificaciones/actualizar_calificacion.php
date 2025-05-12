<?php
include_once "../../conexion.php";

// Verificamos que los datos estén disponibles
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idcalificaciones = $_POST['idcalificaciones'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha'];
    $oferta_empleo_id_oferta_empleo = $_POST['oferta_empleo_id_oferta_empleo'];
    $usuario_id_usuario = $_POST['usuario_id_usuario'];

    // Actualizar la calificación en la base de datos
    $sql = "UPDATE calificaciones 
            SET calificacion = :calificacion, comentario = :comentario, fecha = :fecha,
                oferta_empleo_id_oferta_empleo = :oferta_empleo_id_oferta_empleo,
                usuario_id_usuario = :usuario_id_usuario
            WHERE idcalificaciones = :idcalificaciones";

    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(":calificacion", $calificacion, PDO::PARAM_INT);
    $stmt->bindParam(":comentario", $comentario, PDO::PARAM_STR);
    $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
    $stmt->bindParam(":oferta_empleo_id_oferta_empleo", $oferta_empleo_id_oferta_empleo, PDO::PARAM_INT);
    $stmt->bindParam(":usuario_id_usuario", $usuario_id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(":idcalificaciones", $idcalificaciones, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Si la actualización es exitosa, redirigimos a la página de listado de calificaciones
        header("Location: ../../calificaciones_admin.php");
        exit;
    } else {
        echo "Error al actualizar la calificación.";
    }
} else {
    echo "Solicitud inválida.";
}
?>
