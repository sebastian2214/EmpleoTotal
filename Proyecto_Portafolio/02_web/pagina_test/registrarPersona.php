<?php

// Iniciar sesión
session_start();

// Verificar si se han enviado los datos obligatorios
if (!isset($_POST["titulo_emp"]) || !isset($_POST["descripcion"]) || !isset($_POST["requisitos"]) || !isset($_POST["ubicacion"]) || !isset($_POST["sub_cat_id_sub_cat"])) {
    exit("Faltan datos obligatorios.");
}

include_once "conexion.php";

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    exit("No se encontró información del usuario. Por favor, inicie sesión.");
}

// Obtener el ID del usuario autenticado
$id_usuario = $_SESSION['id_usuario'];

// Consultar el ID de la empresa asociada al usuario autenticado
try {
    $consulta_empresa = $base_de_datos->prepare("SELECT id_empresa FROM empresas WHERE usuario_id_usuario = ?");
    $consulta_empresa->execute([$id_usuario]);
    $empresa = $consulta_empresa->fetch(PDO::FETCH_ASSOC);

    if ($empresa) {
        $empresas_id = $empresa['id_empresa'];
    } else {
        exit("No se encontró empresa asociada al usuario.");
    }
} catch (PDOException $e) {
    exit("Error al consultar la empresa: " . $e->getMessage());
}

// Obtener los datos del formulario
$titulo_emp = $_POST["titulo_emp"];
$descripcion = $_POST["descripcion"];
$requisitos = $_POST["requisitos"];
$ubicacion = $_POST["ubicacion"];
$salario = isset($_POST["salario"]) ? $_POST["salario"] : null; // Opcional
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null; // Opcional
$correo = isset($_POST["correo"]) ? $_POST["correo"] : null; // Opcional
$link_test = isset($_POST["link_test"]) ? $_POST["link_test"] : null; // Nuevo campo opcional
$sub_cat_id_sub_cat = $_POST["sub_cat_id_sub_cat"];

// Verificar si se ha subido una imagen
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) {
    $imagen = $_FILES["imagen"];
    $nombreImagen = uniqid() . "_" . basename($imagen["name"]); // Generar nombre único para evitar colisiones
    $rutaImagen = "uploads/" . $nombreImagen;

    // Crear la carpeta 'uploads' si no existe
    if (!file_exists("uploads/")) {
        mkdir("uploads/", 0777, true); // Crear la carpeta con permisos adecuados
    }

    // Mover la imagen a la carpeta de destino
    if (!move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
        exit("Error al subir la imagen.");
    }
} else {
    $rutaImagen = null; // Si no se sube imagen, dejar como null
}

try {
    // Insertar los datos en la base de datos
    $sentencia = $base_de_datos->prepare("
        INSERT INTO oferta_empleo 
        (titulo_emp, descripcion, requisitos, ubicacion, salario, oferta_empleocol, telefono, correo, link_test, sub_cat_id_sub_cat, empresas_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    ");
    $resultado = $sentencia->execute([
        $titulo_emp,
        $descripcion,
        $requisitos,
        $ubicacion,
        $salario,
        $rutaImagen,
        $telefono,
        $correo,
        $link_test,
        $sub_cat_id_sub_cat,
        $empresas_id
    ]);

    if ($resultado === TRUE) {
        // Redireccionar después de la inserción exitosa
        header("Location: mostrar_datos.php");
        exit();
    } else {
        echo "Algo salió mal. Por favor verifica que la tabla exista.";
    }
} catch (PDOException $e) {
    echo "Error en la inserción: " . $e->getMessage();
}

?>
