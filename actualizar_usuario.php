<?php
// Incluir la conexión
include_once "../../conexion.php";

// Validar que venga por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtener los datos enviados
    $id_usuario = $_POST["id_usuario"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $rol_id_rol = $_POST["rol_id_rol"];

    // Actualizar los datos del usuario (excepto la contraseña)
    $sql = "UPDATE usuario SET usuario = :usuario, correo = :correo, rol_id_rol = :rol_id_rol WHERE id_usuario = :id";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":correo", $correo);
    $stmt->bindParam(":rol_id_rol", $rol_id_rol);
    $stmt->bindParam(":id", $id_usuario, PDO::PARAM_INT);

    // Ejecutar y redirigir
    if ($stmt->execute()) {
        header("Location: ../../usuarios_admin.php");
        exit;
    } else {
        echo "Ocurrió un error al actualizar el usuario.";
    }

} else {
    echo "Acceso no permitido.";
}
?>
