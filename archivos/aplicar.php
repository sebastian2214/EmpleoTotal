<?php
session_start();
require 'conexion.php';

// Inicializar variables para el modal
$titulo_modal = "Error";
$mensaje_modal = "Ocurrió un error desconocido.";
$tipo_modal = "danger"; // Puede ser 'success', 'warning', 'info', o 'danger'

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    $mensaje_modal = "Debes iniciar sesión para aplicar a una oferta.";
} else {
    $id_usuario = $_SESSION['id_usuario'];
    $id_oferta_empleo = isset($_POST['id_oferta_empleo']) ? intval($_POST['id_oferta_empleo']) : '';

    if ($id_oferta_empleo) {
        try {
            // Verificar si el usuario tiene una hoja de vida
            $stmt_hojadevida = $base_de_datos->prepare("SELECT id_hojade_de_vida FROM hojade_de_vida WHERE usuario_id_usuario = :id_usuario");
            $stmt_hojadevida->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt_hojadevida->execute();
            $hojadevida = $stmt_hojadevida->fetch(PDO::FETCH_ASSOC);

            if ($hojadevida) {
                $id_hojade_de_vida = $hojadevida['id_hojade_de_vida'];

                // Verificar si el usuario ya aplicó a esta oferta
                $stmt_verificar = $base_de_datos->prepare("SELECT * FROM hojade_de_vida_has_oferta_empleo WHERE hojade_de_vida_id_hojade_de_vida = :id_hojade_de_vida AND oferta_empleo_id_oferta_empleo = :id_oferta_empleo");
                $stmt_verificar->bindParam(':id_hojade_de_vida', $id_hojade_de_vida, PDO::PARAM_INT);
                $stmt_verificar->bindParam(':id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);
                $stmt_verificar->execute();

                if ($stmt_verificar->rowCount() == 0) {
                    // Registrar la postulación
                    $stmt_aplicar = $base_de_datos->prepare("INSERT INTO hojade_de_vida_has_oferta_empleo (hojade_de_vida_id_hojade_de_vida, oferta_empleo_id_oferta_empleo) VALUES (:id_hojade_de_vida, :id_oferta_empleo)");
                    $stmt_aplicar->bindParam(':id_hojade_de_vida', $id_hojade_de_vida, PDO::PARAM_INT);
                    $stmt_aplicar->bindParam(':id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);
                    $stmt_aplicar->execute();

                    // Obtener el título de la oferta
                    $stmt_oferta = $base_de_datos->prepare("SELECT titulo_emp FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo");
                    $stmt_oferta->bindParam(':id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);
                    $stmt_oferta->execute();
                    $oferta = $stmt_oferta->fetch(PDO::FETCH_ASSOC);
                    $titulo_oferta = $oferta['titulo_emp'];

                    // Insertar notificación
                    $contenido_notificacion = "Has aplicado exitosamente a la oferta: " . htmlspecialchars($titulo_oferta);
                    $stmt_notificacion = $base_de_datos->prepare("INSERT INTO notificaciones (contenido, fecha_envio, usuario_id_usuario) VALUES (:contenido, NOW(), :id_usuario)");
                    $stmt_notificacion->bindParam(':contenido', $contenido_notificacion, PDO::PARAM_STR);
                    $stmt_notificacion->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt_notificacion->execute();

                    $titulo_modal = "¡Aplicación Exitosa!";
                    $mensaje_modal = "Has aplicado exitosamente a la oferta: " . htmlspecialchars($titulo_oferta);
                    $tipo_modal = "success";
                } else {
                    $mensaje_modal = "Ya has aplicado a esta oferta de empleo.";
                    $tipo_modal = "warning";
                }
            } else {
                $mensaje_modal = "No se encontró una hoja de vida asociada a este usuario.";
                $tipo_modal = "info";
            }
        } catch (PDOException $e) {
            $mensaje_modal = "Error al aplicar a la oferta: " . $e->getMessage();
        }
    } else {
        $mensaje_modal = "ID de oferta de empleo no válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Aplicación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Modal de Resultado -->
    <div class="modal fade show" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-<?= $tipo_modal ?>">
                    <h5 class="modal-title text-white" id="responseModalLabel"><?= $titulo_modal ?></h5>
                </div>
                <div class="modal-body">
                    <?= $mensaje_modal ?>
                </div>
                <div class="modal-footer">
                    <!-- Comprobar si id_oferta_empleo está presente antes de pasar a la página de detalle -->
                    <?php if ($id_oferta_empleo): ?>
                        <a href="detalleempleo.php?id=<?= $id_oferta_empleo ?>" class="btn btn-primary">Volver</a>
                    <?php else: ?>
                        <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
