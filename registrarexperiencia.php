<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $hojade_de_vida_id = $_POST['hojade_de_vida_id_hojade_de_vida'] ?? '';
    $empresa = $_POST['empresa'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $ubicacion_empleo = $_POST['ubicacion_empleo'] ?? '';
    $descripcion_labor = $_POST['descripcion_labor'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';

    // Validar que el ID de hoja de vida esté presente
    if (!$hojade_de_vida_id) {
        echo "Error: No se encontró el ID de hoja de vida.";
        exit();
    }

    // Validar que todos los campos estén presentes
    if (empty($empresa) || empty($cargo) || empty($ubicacion_empleo) || empty($descripcion_labor) || empty($fecha_inicio) || empty($fecha_fin)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Preparar la consulta para insertar los datos en la tabla de experiencia laboral
        $query = "INSERT INTO empleototal.experiencia_laboral (
                    empresa, cargo, ubicacion_empleo, descripcion_labor, fecha_inicio, fecha_fin, hojade_de_vida_id_hojade_de_vida
                  ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia SQL
        $stmt = $base_de_datos->prepare($query);

        // Ejecutar la consulta con los datos del formulario
        $stmt->execute([$empresa, $cargo, $ubicacion_empleo, $descripcion_labor, $fecha_inicio, $fecha_fin, $hojade_de_vida_id]);

        echo "Registro de experiencia laboral exitoso.";
        // Redirigir a una página de confirmación o al mismo formulario con un mensaje
        header("Location: volverinicio.php?hojade_de_vida_id_hojade_de_vida=$hojade_de_vida_id&success=true");
        exit();
    } catch (Exception $e) {
        // Manejar errores
        echo "Error al registrar experiencia laboral: " . $e->getMessage();
    }
}
?>
