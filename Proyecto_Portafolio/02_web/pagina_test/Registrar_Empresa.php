<?php 
// Incluir el archivo de conexión
include 'conexion.php';
session_start();  // Iniciar la sesión para acceder a los datos guardados del usuario

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario de empresa
    $nombre_emp = $_POST['nombre_emp'] ?? '';
    $industria = $_POST['industria'] ?? '';  
    $ubicacion = $_POST['ubicacion'] ?? '';
    $tamano_emp = $_POST['tamano_emp'] ?? '';
    $descripcion_emp = $_POST['descripcion_emp'] ?? '';
    $contacto = $_POST['contacto'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $sitio_web_of = $_POST['sitio_web_of'] ?? '';
    $antecedentes = $_POST['antecedentes'] ?? '';
    $mision = $_POST['mision'] ?? '';
    $vision = $_POST['vision'] ?? '';
    $regionales = $_POST['regionales'] ?? '';
    $hitos_significativos = $_POST['hitos_significativos'] ?? '';
    $innovaciones_recientes = $_POST['innovaciones_recientes'] ?? '';
    $beneficios_empleados = $_POST['beneficios_empleados'] ?? '';

    // Verificar si hay datos del usuario en la sesión
    if (isset($_SESSION['usuario'], $_SESSION['correo'], $_SESSION['contrasena'])) {
        // Obtener los datos del usuario de la sesión
        $usuario = $_SESSION['usuario'];
        $correo_usuario = $_SESSION['correo'];
        $contrasena = $_SESSION['contrasena'];
        $rol_id_rol = 2;  // Asignar el rol 2 para "empresa"

        try {
            // Iniciar una transacción
            $base_de_datos->beginTransaction();

            // Insertar los datos del usuario en la tabla `usuario`
            $query_usuario = "INSERT INTO empleototal.usuario (usuario, correo, contrasena, rol_id_rol) VALUES (?, ?, ?, ?)";
            $stmt_usuario = $base_de_datos->prepare($query_usuario);
            $stmt_usuario->execute([$usuario, $correo_usuario, $contrasena, $rol_id_rol]);

            // Obtener el ID del último usuario insertado
            $id_usuario = $base_de_datos->lastInsertId();

            // Insertar los datos de la empresa en la tabla `empresa`
            $query_empresa = "INSERT INTO empleototal.empresas (
                                nombre_emp, industria, ubicacion, tamano_emp, descripcion_emp, 
                                contacto, correo, sitio_web_of, antecedentes, mision, vision, 
                                regionales, hitos_significativos, innovaciones_recientes, 
                                beneficios_empleados, usuario_id_usuario
                              ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_empresa = $base_de_datos->prepare($query_empresa);
            $stmt_empresa->execute([
                $nombre_emp, $industria, $ubicacion, $tamano_emp, $descripcion_emp, 
                $contacto, $correo, $sitio_web_of, $antecedentes, $mision, $vision, 
                $regionales, $hitos_significativos, $innovaciones_recientes, 
                $beneficios_empleados, $id_usuario
            ]);

            // Confirmar la transacción
            $base_de_datos->commit();

            // Limpiar los datos de la sesión
            session_unset();
            session_destroy();

            // Redirigir a la página de éxito
            header('Location: volverinicio.php');
            exit();

        } catch (Exception $e) {
            // Revertir la transacción si ocurre un error
            $base_de_datos->rollBack();
            echo "Error al registrar empresa: " . $e->getMessage();
        }
    } else {
        echo "No se encontraron datos de usuario en la sesión.";
    }
}
?>
