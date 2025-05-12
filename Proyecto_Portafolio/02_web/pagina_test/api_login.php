<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

include 'conexion.php';

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

$key = "mi_clave_secreta"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $usuario = $data['usuario'] ?? '';
    $contrasena = $data['contrasena'] ?? '';

    if (!empty($usuario) && !empty($contrasena)) {
        
        $sql = "SELECT id_usuario, usuario, contrasena, rol_id_rol FROM usuario WHERE usuario = :usuario";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data && password_verify($contrasena, $user_data['contrasena'])) {
           
            $issuedAt = time();
            $expirationTime = $issuedAt + 3600; 
            $payload = [
                "iat" => $issuedAt,
                "exp" => $expirationTime,
                "user_id" => $user_data['id_usuario'],
                "usuario" => $user_data['usuario'],
                "rol" => $user_data['rol_id_rol']
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');
            setcookie('token', $jwt, $expirationTime, '/', '', false, true); 

            
            $redirect_url = '';
            if ($user_data['rol_id_rol'] == 1) {
                $redirect_url = 'inicio.html'; 
            } elseif ($user_data['rol_id_rol'] == 2) {
                $redirect_url = 'index.php'; 
            } elseif ($user_data['rol_id_rol'] == 3) {
                $redirect_url = 'inicio.php'; 
            } else {
                $redirect_url = 'Inicio_Sesion.php'; 
            }

            echo json_encode([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'token' => $jwt,
                'redirect_url' => $redirect_url 
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Campos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
