<?php
include_once "../../conexion.php";

// Verifica que el formulario se haya enviado correctamente
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtener los datos del formulario
    $id_empresa = $_POST['id_empresa'];
    $nombre_emp = $_POST['nombre_emp'];
    $industria = $_POST['industria'];
    $ubicacion = $_POST['ubicacion'];
    $tamano_emp = $_POST['tamano_emp'];
    $descripcion_emp = $_POST['descripcion_emp'];
    $contacto = $_POST['contacto'];
    $correo = $_POST['correo'];
    $sitio_web_of = $_POST['sitio_web_of'];
    $antecedentes = $_POST['antecedentes'];
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];
    $regionales = $_POST['regionales'];
    $hitos_significativos = $_POST['hitos_significativos'];
    $innovaciones_recientes = $_POST['innovaciones_recientes'];
    $beneficios_empleados = $_POST['beneficios_empleados'];
    $usuario_id_usuario = $_POST['usuario_id_usuario'];

    // Preparar la consulta de actualización
    $sql = "UPDATE empresas SET 
                nombre_emp = ?, 
                industria = ?, 
                ubicacion = ?, 
                tamano_emp = ?, 
                descripcion_emp = ?, 
                contacto = ?, 
                correo = ?, 
                sitio_web_of = ?, 
                antecedentes = ?, 
                mision = ?, 
                vision = ?, 
                regionales = ?, 
                hitos_significativos = ?, 
                innovaciones_recientes = ?, 
                beneficios_empleados = ?, 
                usuario_id_usuario = ?
            WHERE id_empresa = ?";

    $stmt = $base_de_datos->prepare($sql);
    $resultado = $stmt->execute([
        $nombre_emp,
        $industria,
        $ubicacion,
        $tamano_emp,
        $descripcion_emp,
        $contacto,
        $correo,
        $sitio_web_of,
        $antecedentes,
        $mision,
        $vision,
        $regionales,
        $hitos_significativos,
        $innovaciones_recientes,
        $beneficios_empleados,
        $usuario_id_usuario,
        $id_empresa
    ]);

    if ($resultado) {
        // Redirigir al listado de empresas si se actualizó con éxito
        header("Location: ../../empresas_admin.php");
        exit;
    } else {
        echo "Error al actualizar la empresa.";
    }

} else {
    echo "Acceso no permitido.";
}
?>
