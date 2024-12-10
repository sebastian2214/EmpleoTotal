<?php
include 'php/conexion.php'; // Conectar a la base de datos
session_start(); // Asegúrate de que la sesión esté iniciada

$id_usuario = $_SESSION['id_usuario'] ?? null;

if (!$id_usuario) {
    die("No estás autenticado.");
}

// Enviar un mensaje
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar_mensaje'])) {
    $id_receptor = $_POST['id_receptor'];
    $contenido = $_POST['contenido'];
    $fecha_envio = date('Y-m-d H:i:s');

    $stmt = $base_de_datos->prepare("
        INSERT INTO mensajes (id_receptor, id_interceptor, contenido, fecha_envio, visto) 
        VALUES (:id_receptor, :id_interceptor, :contenido, :fecha_envio, 0)
    ");
    $stmt->execute([
        'id_receptor' => $id_receptor,
        'id_interceptor' => $id_usuario,
        'contenido' => $contenido,
        'fecha_envio' => $fecha_envio
    ]);

    header("Location: mensajes.php?id_receptor=$id_receptor"); // Redirigir para evitar reenvío del formulario
    exit();
}

// Buscar usuarios con rol 3 en toda la base de datos
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$busqueda = trim($busqueda); // Elimina espacios en blanco innecesarios

// Consulta de usuarios con rol 3
$stmt = $base_de_datos->prepare("
    SELECT u.id_usuario, u.usuario 
    FROM usuario u
    WHERE u.rol_id_rol = 3
    AND u.usuario LIKE :busqueda
");
$stmt->execute([
    'busqueda' => '%' . $busqueda . '%'
]);
$usuarios_conversacion = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Depuración: Mostrar usuarios encontrados
// echo "<pre>" . print_r($usuarios_conversacion, true) . "</pre>";

// Obtener el ID del receptor para mostrar el chat correspondiente
$id_receptor = isset($_GET['id_receptor']) ? $_GET['id_receptor'] : null;

// Consultar mensajes
$mensajes = [];
if ($id_receptor) {
    $stmt = $base_de_datos->prepare("
        SELECT m.id_mensajes, m.id_receptor, m.id_interceptor, m.contenido, m.fecha_envio, u.usuario AS usuario_interceptor
        FROM mensajes m
        JOIN usuario u ON m.id_interceptor = u.id_usuario
        WHERE (m.id_receptor = :id_receptor AND m.id_interceptor = :id_usuario) OR (m.id_receptor = :id_usuario AND m.id_interceptor = :id_receptor)
        ORDER BY m.fecha_envio ASC
    ");
    $stmt->execute(['id_receptor' => $id_receptor, 'id_usuario' => $id_usuario]);
    $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Marcar los mensajes como vistos
    $stmt = $base_de_datos->prepare("
        UPDATE mensajes
        SET visto = 1
        WHERE id_receptor = :id_usuario AND id_interceptor = :id_receptor AND visto = 0
    ");
    $stmt->execute(['id_usuario' => $id_usuario, 'id_receptor' => $id_receptor]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./mensajes.css">
    <style>
        .message-item {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sent {
            background-color: #d1e7dd;
            text-align: right;
        }
        .received {
            background-color: #f8d7da;
            text-align: left;
        }
        #chatBox {
            max-height: 400px;
            overflow-y: auto;
        }
        .badge-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <img src="img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
            <div class="user-icons">
            <button class="btn btn-lila me-2" onclick="location.href='index.php'">Volver</button>
                <!--<button class="btn-lila" onclick="location.href='notificacionem.php'"></button>
                <button class="user-icon-btn" onclick="toggleSidebar()">
                    <i class="fa fa-bars user-icon"></i>
                </button>-->
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <section class="container-fluid main-content d-flex flex-column flex-md-row pt-5">
        <!-- Lista de Mensajes -->
        <article class="col-12 col-md-4 message-list bg-white rounded p-3 mb-3 mb-md-0">
            <h2>Conversaciones</h2>
            <form method="GET" class="search-bar">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar usuario..." value="<?= htmlspecialchars($busqueda) ?>">
                <button type="submit" class="btn btn-primary mt-2">Buscar</button>
            </form>
            <?php if (empty($usuarios_conversacion)): ?>
                <p>No has tenido conversaciones.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($usuarios_conversacion as $usuario): ?>
                        <?php
                        // Contar mensajes no leídos
                        $stmt = $base_de_datos->prepare("
                            SELECT COUNT(*) as count
                            FROM mensajes
                            WHERE id_receptor = :id_usuario AND id_interceptor = :id_receptor AND visto = 0
                        ");
                        $stmt->execute(['id_usuario' => $id_usuario, 'id_receptor' => $usuario['id_usuario']]);
                        $count = $stmt->fetchColumn();
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($usuario['usuario']) ?>
                            <?php if ($count > 0): ?>
                                <span class="badge bg-danger"><?= $count ?></span>
                            <?php endif; ?>
                            <a href="?id_receptor=<?= $usuario['id_usuario'] ?>&busqueda=<?= htmlspecialchars($busqueda) ?>" class="btn btn-primary btn-sm">Ver Chat</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </article>

        <!-- Detalles del Mensaje y Enviar Mensaje -->
        <article class="col-12 col-md-8 message-box bg-white rounded">
            <?php
            // Definir el nombre del usuario para el encabezado del chat
            $usuario_nombre = 'Selecciona un usuario para iniciar el chat';
            if ($id_receptor) {
                // Crear un array asociativo de usuarios por ID
                $usuarios_asociados = array_column($usuarios_conversacion, 'usuario', 'id_usuario');
                
                // Verificar si el ID del receptor está en el array
                if (isset($usuarios_asociados[$id_receptor])) {
                    $usuario_nombre = htmlspecialchars($usuarios_asociados[$id_receptor]);
                }
            }
            ?>
            <h3 id="chatUser">Chat con <?= $usuario_nombre ?></h3>
            <div id="chatBox">
                <?php if ($id_receptor && empty($mensajes)): ?>
                    <p>No tienes mensajes.</p>
                <?php else: ?>
                    <?php foreach ($mensajes as $mensaje): ?>
                        <div class="message-item <?= $mensaje['id_interceptor'] == $id_usuario ? 'sent' : 'received' ?>">
                            <p><?= htmlspecialchars($mensaje['contenido']) ?></p>
                            <p class="text-muted"><?= htmlspecialchars($mensaje['fecha_envio']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if ($id_receptor): ?>
                <form method="POST" action="mensajes.php" id="messageForm">
                    <input type="hidden" name="id_receptor" value="<?= $id_receptor ?>">
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Mensaje</label>
                        <textarea class="form-control" name="contenido" id="contenido" rows="4" required></textarea>
                    </div>
                    <button type="submit" name="enviar_mensaje" class="btn btn-primary btn-send">Enviar Mensaje</button>
                </form>
            <?php endif; ?>
        </article>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Desplazamiento automático al último mensaje
        document.addEventListener('DOMContentLoaded', function() {
            var chatBox = document.getElementById('chatBox');
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
</body>
</html>
