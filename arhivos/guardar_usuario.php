<?php
// Incluir el archivo de conexión a la base de datos
include('../../conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $rol_id_rol = $_POST['rol_id_rol'];

    // Encriptar la contraseña
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar el nuevo usuario
    $sql = "INSERT INTO usuario (usuario, correo, contrasena, rol_id_rol) VALUES (:usuario, :correo, :contrasena, :rol_id_rol)";

    // Ejecutar la consulta
    try {
        $stmt = $base_de_datos->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena_encriptada);
        $stmt->bindParam(':rol_id_rol', $rol_id_rol);

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Redirigir a la lista de usuarios después de agregar el nuevo usuario
            header('Location: ../../usuarios_admin.php');
            exit;
        } else {
            echo "Error al agregar el usuario. Por favor, inténtalo de nuevo.";
        }
    } catch (Exception $e) {
        echo "Ocurrió un error: " . $e->getMessage();
    }
}
?>
