<?php
include 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');

    if (empty($correo)) {
        echo "Por favor, proporciona un correo.";
        exit;
    }

    try {
        // Verificar si el correo existe en la base de datos
        $query = "SELECT * FROM usuario WHERE correo = :correo";
        $stmt = $base_de_datos->prepare($query);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Generar un token único
            $token = bin2hex(random_bytes(50));

            // Almacenar el token en la base de datos
            $query = "INSERT INTO recuperar_contra (correo, token) VALUES (:correo, :token)";
            $stmt = $base_de_datos->prepare($query);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            // Configurar PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Cambia esto al host de tu servidor SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'gustavosisabe@gmail.com'; // Cambia esto a tu dirección de correo
                $mail->Password = 'oarx eube iwtk prtp'; // Cambia esto a tu contraseña
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Configuración del correo electrónico
                $mail->setFrom('gustavosisabe@gmail.com', 'EmpleoTotal');
                $mail->addAddress($correo);
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body = "Tu token es el siguiente: ($token) DEBES INGRESARLO PARA PODER RESTABLECER TU CONTRASEÑA. Haz clic en el siguiente enlace para restablecer tu contraseña: 
                http://localhost/pagina_test/formulario_cambiar.php";

                $mail->send();
                echo "Correo enviado. Revisa tu bandeja de entrada.";
            } catch (Exception $e) {
                echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Correo no encontrado.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
