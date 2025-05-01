<?php
session_start();
require 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

// Inicializar variables
$nombre_usuario = '';
$notificaciones = [];

// Consultar el nombre del usuario
try {
    $stmt_usuario = $base_de_datos->prepare("SELECT usuario FROM usuario WHERE id_usuario = :id_usuario");
    $stmt_usuario->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $stmt_usuario->execute();
    $usuario_data = $stmt_usuario->fetch(PDO::FETCH_ASSOC);
    $nombre_usuario = $usuario_data['usuario'] ?? 'Usuario';
} catch (PDOException $e) {
    echo "Error al consultar la base de datos: " . $e->getMessage();
    exit;
}

// Consultar las notificaciones
try {
    $stmt_notificaciones = $base_de_datos->prepare("SELECT * FROM notificaciones WHERE usuario_id_usuario = :id_usuario ORDER BY fecha_envio DESC");
    $stmt_notificaciones->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $stmt_notificaciones->execute();
    $notificaciones = $stmt_notificaciones->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al consultar las notificaciones: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="notificacion.css">
    <style>
        .btn-lila {
            background-color: #6a0dad;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
            border-radius: 5px;
        }
        .btn-lila:hover {
            background-color: #4b0082;
        }
        .notification {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .notification h3 {
            margin: 0;
            font-size: 18px;
        }
        .notification p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <img src="./imagenes/logoTotal.png" alt="Logo" class="logo">
                <div class="nav-buttons">
                    <button class="btn btn-lila" onclick="location.href='./inicio.php'">Volver a Inicio</button>
                </div>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        <h2 class="text-center">Notificaciones</h2>
        <div class="notifications">
            <?php foreach ($notificaciones as $notificacion): ?>
                <div class="notification p-3 mb-3 bg-white rounded shadow-sm">
                    <h3><?php echo htmlspecialchars($nombre_usuario); ?></h3>
                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($notificacion['fecha_envio']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($notificacion['contenido'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Empresa. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
