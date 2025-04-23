<?php
// Incluir el archivo de conexión a la base de datos
include('../../conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $intitucion = $_POST['intitucion'];
    $titulo = $_POST['titulo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $hoja_vida_id = $_POST['hojade_de_vida_id_hojade_de_vida'];

    // Preparar la consulta para insertar el nuevo estudio
    $sql = "INSERT INTO estudios (intitucion, titulo, fecha_inicio, fecha_fin, hojade_de_vida_id_hojade_de_vida) 
            VALUES (:intitucion, :titulo, :fecha_inicio, :fecha_fin, :hoja_vida_id)";

    try {
        $stmt = $base_de_datos->prepare($sql);
        $stmt->bindParam(':intitucion', $intitucion);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':hoja_vida_id', $hoja_vida_id);

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            header('Location: ../../estudios_admin.php');
            exit;
        } else {
            echo "Error al agregar el estudio. Por favor, inténtalo de nuevo.";
        }
    } catch (Exception $e) {
        echo "Ocurrió un error: " . $e->getMessage();
    }
}
?>
