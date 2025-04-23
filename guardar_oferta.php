<?php
include_once "../../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_emp = $_POST['titulo_emp'];
    $empresas_id = $_POST['empresas_id'];
    $descripcion = $_POST['descripcion'];
    $requisitos = $_POST['requisitos'];
    $ubicacion = $_POST['ubicacion'];
    $salario = $_POST['salario'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $link_test = $_POST['link_test'];
    $sub_cat_id_sub_cat = $_POST['sub_cat_id_sub_cat'];

    $imagen_url = null;

    if (isset($_FILES['oferta_empleocol']) && $_FILES['oferta_empleocol']['error'] == 0) {
        $imagen = $_FILES['oferta_empleocol'];
        $imagen_nombre = uniqid() . "_" . basename($imagen['name']); // nombre único
        $ruta_fisica = "../../uploads/" . $imagen_nombre;
        $ruta_publica = "uploads/" . $imagen_nombre;

        // Verifica que exista el directorio uploads
        if (!file_exists("../../uploads/")) {
            mkdir("../../uploads/", 0777, true);
        }

        if (move_uploaded_file($imagen['tmp_name'], $ruta_fisica)) {
            $imagen_url = $ruta_publica; // esta es la que guardamos en la base de datos
        } else {
            echo "Error al mover la imagen.";
            exit();
        }
    }

    $sql = "INSERT INTO oferta_empleo 
            (titulo_emp, empresas_id, descripcion, requisitos, ubicacion, salario, oferta_empleocol, telefono, correo, link_test, sub_cat_id_sub_cat)
            VALUES (:titulo_emp, :empresas_id, :descripcion, :requisitos, :ubicacion, :salario, :oferta_empleocol, :telefono, :correo, :link_test, :sub_cat_id_sub_cat)";

    $stmt = $base_de_datos->prepare($sql);
    $stmt->bindParam(':titulo_emp', $titulo_emp);
    $stmt->bindParam(':empresas_id', $empresas_id);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':requisitos', $requisitos);
    $stmt->bindParam(':ubicacion', $ubicacion);
    $stmt->bindParam(':salario', $salario);
    $stmt->bindParam(':oferta_empleocol', $imagen_url);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':link_test', $link_test);
    $stmt->bindParam(':sub_cat_id_sub_cat', $sub_cat_id_sub_cat);

    if ($stmt->execute()) {
        header("Location: ../../ofertas_empleo_admin.php");
        exit();
    } else {
        echo "Error al agregar la oferta de empleo.";
    }
}
?>