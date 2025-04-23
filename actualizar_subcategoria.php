<?php
include_once "../../conexion.php";

// Verificamos que se haya enviado el ID de la subcategoría
if (!isset($_POST["id_sub_cat"])) {
    echo "No se especificó el ID de la subcategoría para actualizar.";
    exit;
}

$id_sub_cat = $_POST["id_sub_cat"];
$nombre_sub_cat = $_POST["nombre_sub_cat"];
$categoria_id_categora = $_POST["categoria_id_categora"];

// Verificamos que los campos no estén vacíos
if (empty($nombre_sub_cat) || empty($categoria_id_categora)) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// SQL de actualización
$sql = "UPDATE sub_cat 
        SET nombre_sub_cat = :nombre_sub_cat, categoria_id_categora = :categoria_id_categora 
        WHERE id_sub_cat = :id_sub_cat";

// Preparamos la sentencia
$stmt = $base_de_datos->prepare($sql);

// Vinculamos los valores
$stmt->bindParam(":nombre_sub_cat", $nombre_sub_cat, PDO::PARAM_STR);
$stmt->bindParam(":categoria_id_categora", $categoria_id_categora, PDO::PARAM_INT);
$stmt->bindParam(":id_sub_cat", $id_sub_cat, PDO::PARAM_INT);

// Ejecutamos la sentencia
if ($stmt->execute()) {
    // Redirigimos a la página de subcategorías con un mensaje de éxito
    header("Location: ../../subcategorias_admin.php");
    exit;
} else {
    echo "Error al actualizar la subcategoría.";
}
?>
