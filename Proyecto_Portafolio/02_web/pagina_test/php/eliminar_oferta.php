<?php
if (!isset($_POST["id_oferta_empleo"])) {
    exit("Error: No se recibió el ID de la oferta de empleo.");
}

$id_oferta_empleo = $_POST["id_oferta_empleo"];

include_once "conexion.php";

try {
    $sentencia = $base_de_datos->prepare("DELETE FROM oferta_empleo WHERE id_oferta_empleo = ?;");
    $resultado = $sentencia->execute([$id_oferta_empleo]);

    if ($resultado) {
        echo '
        <script>
            alert("La oferta de empleo ha sido eliminada correctamente.");
            window.location.href = "mostrar_datos.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("La oferta de empleo NO pudo ser eliminada.");
            window.location.href = "mostrar_datos.php";
        </script>
        ';
    }
} catch (PDOException $e) {
    echo '
    <script>
        alert("Error al intentar eliminar la oferta de empleo: ' . $e->getMessage() . '");
        window.location.href = "mostrar_datos.php";
    </script>
    ';
}
?>
