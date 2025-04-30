<?php
include_once "../../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_oferta_empleo = $_POST["id_oferta_empleo"];
    $titulo_emp = $_POST["titulo_emp"];
    $empresas_id = $_POST["empresas_id"];
    $descripcion = $_POST["descripcion"];
    $requisitos = $_POST["requisitos"];
    $ubicacion = $_POST["ubicacion"];
    $salario = $_POST["salario"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $sub_cat_id_sub_cat = $_POST["sub_cat_id_sub_cat"];
    $link_test = $_POST["link_test"];

    // Manejo de la imagen subida
    $imagen = $_POST["oferta_empleocol_actual"]; // Mantener la imagen actual si no se sube nueva
    if (isset($_FILES["oferta_empleocol"]) && $_FILES["oferta_empleocol"]["error"] == 0) {
        $nombre_imagen = $_FILES["oferta_empleocol"]["name"];
        $ruta_temporal = $_FILES["oferta_empleocol"]["tmp_name"];
        $ruta_destino = "uploads/" . $nombre_imagen;

        if (move_uploaded_file($ruta_temporal, "../../" . $ruta_destino)) {
            $imagen = $ruta_destino; // Guardar la ruta relativa correcta en la base de datos
        }
    }

    // Actualizar los datos en la base de datos
    try {
        $query = "UPDATE oferta_empleo SET 
                    titulo_emp = ?, 
                    empresas_id = ?, 
                    descripcion = ?, 
                    requisitos = ?, 
                    ubicacion = ?, 
                    salario = ?, 
                    telefono = ?, 
                    correo = ?, 
                    sub_cat_id_sub_cat = ?, 
                    oferta_empleocol = ?, 
                    link_test = ?
                  WHERE id_oferta_empleo = ?";
        $sentencia = $base_de_datos->prepare($query);
        $sentencia->execute([
            $titulo_emp,
            $empresas_id,
            $descripcion,
            $requisitos,
            $ubicacion,
            $salario,
            $telefono,
            $correo,
            $sub_cat_id_sub_cat,
            $imagen,
            $link_test,
            $id_oferta_empleo
        ]);

        header("Location: ../../ofertas_empleo_admin.php");
        exit();
    } catch (PDOException $e) {
        exit("Error al actualizar la oferta: " . $e->getMessage());
    }
}
?>
