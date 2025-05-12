<?php
include('../../conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = htmlspecialchars($_POST['correo']);
    $estado_civil = htmlspecialchars($_POST['estado_civil']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nacionalidad = htmlspecialchars($_POST['nacionalidad']);
    $descripcion_sobre_ti = htmlspecialchars($_POST['descripcion_sobre_ti']);
    $objetivo_profecional = htmlspecialchars($_POST['objetivo_profecional']);
    $idiomas = htmlspecialchars($_POST['idiomas']);
    $referencias = htmlspecialchars($_POST['referencias']);
    $parentezco = htmlspecialchars($_POST['parentezco']);
    $numero_referencia = htmlspecialchars($_POST['numero_referencia']);
    $intereses_personales = htmlspecialchars($_POST['intereses_personales']);
    $disponibilidad_trabajo = htmlspecialchars($_POST['disponibilidad_trabajo']);
    $usuario_id_usuario = $_POST['usuario_id_usuario'];

    // Preparar la consulta para insertar los datos en la base de datos
    $sql = "INSERT INTO hojade_de_vida 
            (nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, 
            nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, 
            parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo, usuario_id_usuario) 
            VALUES 
            (:nombre, :apellido, :direccion, :telefono, :correo, :estado_civil, :fecha_nacimiento, 
            :nacionalidad, :descripcion_sobre_ti, :objetivo_profecional, :idiomas, :referencias, 
            :parentezco, :numero_referencia, :intereses_personales, :disponibilidad_trabajo, :usuario_id_usuario)";

    $stmt = $base_de_datos->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':estado_civil', $estado_civil);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':descripcion_sobre_ti', $descripcion_sobre_ti);
    $stmt->bindParam(':objetivo_profecional', $objetivo_profecional);
    $stmt->bindParam(':idiomas', $idiomas);
    $stmt->bindParam(':referencias', $referencias);
    $stmt->bindParam(':parentezco', $parentezco);
    $stmt->bindParam(':numero_referencia', $numero_referencia);
    $stmt->bindParam(':intereses_personales', $intereses_personales);
    $stmt->bindParam(':disponibilidad_trabajo', $disponibilidad_trabajo);
    $stmt->bindParam(':usuario_id_usuario', $usuario_id_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir o mostrar mensaje de éxito
        header("Location: ../../hojas_vida_admin.php");
        exit;
    } else {
        // Mostrar mensaje de error si algo salió mal
        echo "Error al guardar la hoja de vida. Intente nuevamente.";
    }
}
?>
