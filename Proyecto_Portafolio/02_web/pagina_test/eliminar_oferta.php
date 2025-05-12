<?php
session_start();
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_oferta_empleo"])) {
    $id_oferta_empleo = $_POST["id_oferta_empleo"];

    try {
        // Eliminar la oferta de empleo
        $delete_query = "DELETE FROM oferta_empleo WHERE id_oferta_empleo = ?";
        $sentencia = $base_de_datos->prepare($delete_query);
        $sentencia->execute([$id_oferta_empleo]);

        header("Location: mostrar_datos.php"); // Redirigir después de eliminar
        exit;
    } catch (PDOException $e) {
        exit("Error al eliminar la oferta: " . $e->getMessage());
    }
} else {
    exit("¡No se recibió el ID de la oferta!");
}
?>
