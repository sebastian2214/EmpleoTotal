<?php

// Verificar si se han enviado los datos obligatorios
if (!isset($_POST["titulo_emp"]) || !isset($_POST["descripcion"]) || !isset($_POST["requisitos"]) || !isset($_POST["ubicacion"]) || !isset($_POST["salario"])) {
    exit("Faltan datos obligatorios.");
}

include_once "conexion.php";

// Obtener los datos del formulario
$titulo_emp = $_POST["titulo_emp"];
$descripcion = $_POST["descripcion"];
$requisitos = $_POST["requisitos"];
$ubicacion = $_POST["ubicacion"];
$salario = $_POST["salario"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$sub_cat_id_sub_cat = $_POST["sub_cat_id_sub_cat"];

// Verificar si se ha subido una imagen
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) {
    $imagen = $_FILES["imagen"];
    $nombreImagen = uniqid() . "_" . basename($imagen["name"]);  // Generar nombre único para evitar colisiones
    $rutaImagen = "uploads/" . $nombreImagen;

    // Crear la carpeta 'uploads' si no existe
    if (!file_exists("uploads/")) {
        mkdir("uploads/", 0777, true);  // Crear la carpeta con permisos adecuados
    }

    // Mover la imagen a la carpeta de destino
    if (!move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
        exit("Error al subir la imagen.");
    }
} else {
    $rutaImagen = null;  // Si no se sube imagen, dejar como null o definir un valor por defecto
}

try {
    // Insertar los datos en la base de datos junto con la ruta de la imagen (si se subió)
    $sentencia = $base_de_datos->prepare("INSERT INTO oferta_empleo (titulo_emp, descripcion, requisitos, ubicacion, salario, oferta_empleocol, telefono, correo, sub_cat_id_sub_cat ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([$titulo_emp, $descripcion, $requisitos, $ubicacion, $salario, $rutaImagen, $telefono, $correo, $sub_cat_id_sub_cat]);

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
