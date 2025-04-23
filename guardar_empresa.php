<?php
// Incluir la conexión a la base de datos
include('../../conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
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

    // Preparar la consulta SQL para insertar la empresa en la base de datos
    $query = "INSERT INTO empresas (
        nombre_emp,
        industria,
        ubicacion,
        tamano_emp,
        descripcion_emp,
        contacto,
        correo,
        sitio_web_of,
        antecedentes,
        mision,
        vision,
        regionales,
        hitos_significativos,
        innovaciones_recientes,
        beneficios_empleados,
        usuario_id_usuario
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = $base_de_datos->prepare($query);

    // Ejecutar la consulta con los datos recibidos
    $stmt->execute([
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
        $usuario_id_usuario
    ]);

    // Redirigir a la lista de empresas después de guardar
    header("Location: ../../empresas_admin.php");
    exit;
}
?>
