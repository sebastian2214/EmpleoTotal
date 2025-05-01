<?php
session_start();
require 'conexion.php';

// Verificar si el empleador ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Inicio_Sesion.php");
    exit;
}

// Verificar si se recibió la acción y el id de la hoja de vida
if (isset($_POST['accion'], $_POST['id_hojade_de_vida'])) {
    $accion = $_POST['accion'];
    $id_hojade_de_vida = intval($_POST['id_hojade_de_vida']);

    // Actualizar el estado de la postulación
    $nuevo_estado = ($accion == 'aceptar') ? 'aceptado' : 'rechazado';
    $stmt_actualizar = $base_de_datos->prepare("UPDATE hojade_de_vida_has_oferta_empleo SET estado_postulacion = :nuevo_estado WHERE hojade_de_vida_id_hojade_de_vida = :id_hojade_de_vida");
    $stmt_actualizar->bindParam(':nuevo_estado', $nuevo_estado);
    $stmt_actualizar->bindParam(':id_hojade_de_vida', $id_hojade_de_vida, PDO::PARAM_INT);
    $stmt_actualizar->execute();

    // Enviar mensaje al postulante
    if ($nuevo_estado == 'aceptado') {
        $mensaje = "¡Felicitaciones! Has sido aceptado para la oferta de empleo.";
    } else {
        $mensaje = "Lamentablemente, tu postulación ha sido rechazada.";
    }

    // Obtener el correo del postulante
    $stmt_postulante = $base_de_datos->prepare("SELECT email FROM hojade_de_vida WHERE id_hojade_de_vida = :id_hojade_de_vida");
    $stmt_postulante->bindParam(':id_hojade_de_vida', $id_hojade_de_vida, PDO::PARAM_INT);
    $stmt_postulante->execute();
    $postulante = $stmt_postulante->fetch(PDO::FETCH_ASSOC);

    if ($postulante) {
        $correo_postulante = $postulante['email'];
        $asunto = "Actualización de tu postulación";
        
        // Enviar el correo
        if (mail($correo_postulante, $asunto, $mensaje)) {
            echo "Notificación enviada al postulante.";
        } else {
            echo "Error al enviar la notificación.";
        }
    }

    // Redirigir de vuelta a la página de gestionar postulantes
    header("Location: gestionar_postulantes.php");
    exit;
}
