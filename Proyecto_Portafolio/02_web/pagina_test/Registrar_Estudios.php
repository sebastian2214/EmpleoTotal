<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

try {
    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los valores del formulario
        $hojade_de_vida_id = $_POST['hojade_de_vida_id_hojade_de_vida'] ?? '';
        $intitucion = $_POST['intitucion'] ?? '';  // Mantener 'intitucion' como en la base de datos
        $titulo = $_POST['titulo'] ?? '';
        $fecha_inicio = $_POST['fecha_inicio'] ?? '';
        $fecha_fin = $_POST['fecha_fin'] ?? '';

        // Validar que el ID de hoja de vida esté presente
        if (empty($hojade_de_vida_id)) {
            throw new Exception("Error: No se encontró el ID de hoja de vida.");
        }

        // Iniciar una transacción
        $base_de_datos->beginTransaction();

        // Preparar la consulta para insertar los datos en la tabla de estudios
        $query = "INSERT INTO empleototal.estudios (
                    intitucion, titulo, fecha_inicio, fecha_fin, hojade_de_vida_id_hojade_de_vida
                  ) VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la sentencia SQL
        $stmt = $base_de_datos->prepare($query);

        // Ejecutar la consulta con los datos del formulario
        $stmt->execute([$intitucion, $titulo, $fecha_inicio, $fecha_fin, $hojade_de_vida_id]);

        // Confirmar la transacción
        $base_de_datos->commit();

        // Redirigir al formulario de `RegistroEstudios.php` con el ID enviado como parámetro
        header("Location: elegirexperiencia.php?hojade_de_vida_id_hojade_de_vida=" . urlencode($hojade_de_vida_id));
        exit();
    }
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    if ($base_de_datos->inTransaction()) {
        $base_de_datos->rollBack();
    }

    // Mostrar el mensaje de error
    echo "Error al registrar estudios: " . $e->getMessage();
}
?>
