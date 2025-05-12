<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, GET");

$key = "mi_clave_secreta"; // Clave secreta usada para firmar los tokens

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

if ($authHeader) {
    $jwt = str_replace('Bearer ', '', $authHeader);

    try {
        // Decodificar el token
        $decoded = JWT::decode($jwt, $key, ['HS256']);
        $decoded_array = (array) $decoded;

        echo json_encode(['success' => true, 'user' => $decoded_array]);
    } catch (Exception $e) {
        // Si el token no es válido
        echo json_encode(['success' => false, 'message' => 'Token inválido o expirado']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Token no proporcionado']);
    exit();
}
?>
