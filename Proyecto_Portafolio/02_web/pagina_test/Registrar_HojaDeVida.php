<?php
// Incluir el archivo de conexión
include 'conexion.php';
session_start();  // Iniciar la sesión para acceder a los datos guardados del usuario

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario de hoja de vida
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $estado_civil = $_POST['estado_civil'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $nacionalidad = $_POST['nacionalidad'] ?? '';
    $descripcion_sobre_ti = $_POST['descripcion_sobre_ti'] ?? '';
    $objetivo_profesional = $_POST['objetivo_profecional'] ?? ''; // Corregir el nombre si es necesario
    $idiomas = $_POST['idiomas'] ?? '';
    $referencias = $_POST['referencias'] ?? '';
    $parentezco = $_POST['parentezco'] ?? '';
    $numero_referencia = $_POST['numero_referencia'] ?? '';
    $intereses_personales = $_POST['intereses_personales'] ?? '';
    $disponibilidad_trabajo = $_POST['disponibilidad_trabajo'] ?? '';

    // Verificar si hay datos del usuario en la sesión
    if (isset($_SESSION['usuario'], $_SESSION['correo'], $_SESSION['contrasena'])) {
        // Obtener los datos del usuario de la sesión
        $usuario = $_SESSION['usuario'];
        $correo_usuario = $_SESSION['correo'];
        $contrasena = $_SESSION['contrasena'];
        $rol_id_rol = 3;  // Asignar el rol 3 para "empleado"

        try {
            // Iniciar una transacción
            $base_de_datos->beginTransaction();

            // Insertar los datos del usuario en la tabla `usuario`
            $query_usuario = "INSERT INTO empleototal.usuario (usuario, correo, contrasena, rol_id_rol) VALUES (?, ?, ?, ?)";
            $stmt_usuario = $base_de_datos->prepare($query_usuario);
            $stmt_usuario->execute([$usuario, $correo_usuario, $contrasena, $rol_id_rol]);

            // Obtener el ID del último usuario insertado
            $id_usuario = $base_de_datos->lastInsertId();

            // Insertar los datos de la hoja de vida en la tabla `hojade_de_vida`
            $query_hoja_de_vida = "INSERT INTO empleototal.hojade_de_vida (
                                    nombre, apellido, direccion, telefono, correo, estado_civil, 
                                    fecha_nacimiento, nacionalidad, descripcion_sobre_ti, 
                                    objetivo_profecional, idiomas, referencias, parentezco, 
                                    numero_referencia, intereses_personales, disponibilidad_trabajo, 
                                    usuario_id_usuario
                                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_hoja_de_vida = $base_de_datos->prepare($query_hoja_de_vida);
            $stmt_hoja_de_vida->execute([
                $nombre, $apellido, $direccion, $telefono, $correo, $estado_civil, 
                $fecha_nacimiento, $nacionalidad, $descripcion_sobre_ti, 
                $objetivo_profecional, $idiomas, $referencias, $parentezco, 
                $numero_referencia, $intereses_personales, $disponibilidad_trabajo, 
                $id_usuario
            ]);

            // Obtener el ID de la hoja de vida recién insertada
            $id_hojade_de_vida = $base_de_datos->lastInsertId();

            // Confirmar la transacción  
            $base_de_datos->commit();

            // Limpiar los datos de la sesión
            session_unset();
            session_destroy();

            // Redirigir a la página de registro de estudios con el ID de la hoja de vida
            header("Location: RegistroEstudios.php?id_hojade_de_vida=$id_hojade_de_vida");
            exit();

        } catch (Exception $e) {
            // Revertir la transacción si ocurre un error
            $base_de_datos->rollBack();
            echo "Error al registrar hoja de vida: " . $e->getMessage();
        }
    } else {
        echo "No se encontraron datos de usuario en la sesión.";
    }
}
?>
