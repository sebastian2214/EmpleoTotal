<?php

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = trim($_POST['token'] ?? '');
    $nueva_contraseña = trim($_POST['nueva_contraseña'] ?? '');

    if (empty($token) || empty($nueva_contraseña)) {
        echo "Token o nueva contraseña no proporcionados.";
        exit;
    }

    try {
        // Verificar si el token es válido
        $query = "SELECT correo FROM recuperar_contra WHERE token = :token";
        $stmt = $base_de_datos->prepare($query);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Obtener el correo asociado al token
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $correo = $row['correo'];

            // Actualizar la contraseña del usuario
            $hashedPassword = password_hash($nueva_contraseña, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE usuario SET contrasena = :contrasena WHERE correo = :correo";
            $updateStmt = $base_de_datos->prepare($updateQuery);
            $updateStmt->bindParam(':contrasena', $hashedPassword, PDO::PARAM_STR);
            $updateStmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $updateStmt->execute();

            echo "Contraseña actualizada exitosamente.";
        } else {
            echo "Token no válido o expirado.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
