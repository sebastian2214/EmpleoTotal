<?php
include_once "conexion.php";

if (!isset($_POST["id_oferta_empleo"])) {
    exit("No se recibió el ID de la oferta");
}

$id = $_POST["id_oferta_empleo"];
$titulo_emp = $_POST["titulo_emp"];
$descripcion = $_POST["descripcion"];
$requisitos = $_POST["requisitos"];
$ubicacion = $_POST["ubicacion"];
$salario = $_POST["salario"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$sub_cat_id_sub_cat = $_POST["sub_cat_id_sub_cat"];

$directorio_subida = "../php/uploads/";  // Directorio donde se almacenarán las imágenes

// Comprobar si se subió una nueva imagen
if (isset($_FILES["oferta_empleocol"]) && $_FILES["oferta_empleocol"]["error"] == 0) {
    // Procesar la subida de la imagen
    $nombreArchivo = basename($_FILES["oferta_empleocol"]["name"]);
    $rutaArchivo = $directorio_subida . $nombreArchivo;

    // Mover el archivo subido a la carpeta de destino
    if (move_uploaded_file($_FILES["oferta_empleocol"]["tmp_name"], $rutaArchivo)) {
        $oferta_empleocol = $rutaArchivo; // Ruta donde se guardó la nueva imagen
    } else {
        exit("Error al subir la imagen.");
    }
} else {
    // Si no se subió una nueva imagen, mantener la imagen anterior
    $sentencia = $base_de_datos->prepare("SELECT oferta_empleocol FROM oferta_empleo WHERE id_oferta_empleo = ?");
    $sentencia->execute([$id]);
    $oferta_existente = $sentencia->fetch(PDO::FETCH_OBJ);
    $oferta_empleocol = $oferta_existente->oferta_empleocol;
}

try {
    // Actualizar la oferta en la base de datos
    $sentencia = $base_de_datos->prepare("UPDATE oferta_empleo SET titulo_emp = ?, descripcion = ?, requisitos = ?, ubicacion = ?, salario = ?, oferta_empleocol = ?, telefono = ?, correo = ?, sub_cat_id_sub_cat = ? WHERE id_oferta_empleo = ?;");
    $resultado = $sentencia->execute([$titulo_emp, $descripcion, $requisitos, $ubicacion, $salario, $oferta_empleocol, $telefono, $correo, $sub_cat_id_sub_cat, $id]);

    if ($resultado === true) {
        echo "¡Oferta de empleo actualizada con éxito!";
        header("Location: mostrar_datos.php");
    } else {
        echo "Error al actualizar la oferta de empleo";
    }
} catch (PDOException $e) {
    echo "Error al actualizar la oferta: " . $e->getMessage();
}
?>
