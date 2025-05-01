<?php
// Guardar calificación en la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('../../conexion.php');

    // Obtener los datos del formulario
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha'];
    $oferta_empleo_id_oferta_empleo = $_POST['oferta_empleo_id_oferta_empleo'];
    $usuario_id_usuario = $_POST['usuario_id_usuario'];

    // Insertar la nueva calificación en la base de datos
    $query = "INSERT INTO calificaciones (calificacion, comentario, fecha, oferta_empleo_id_oferta_empleo, usuario_id_usuario) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$calificacion, $comentario, $fecha, $oferta_empleo_id_oferta_empleo, $usuario_id_usuario]);

    // Redirigir al listado de calificaciones después de guardar
    header("Location: ../../calificaciones_admin.php");
    exit;
}
?>
