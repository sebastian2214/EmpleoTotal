<?php
session_start();
require 'conexion.php';

// Inicializar la variable $usuario_iniciado como false
$usuario_iniciado = false;
$nombre_usuario = '';

// Verificar si el usuario está logueado
if (isset($_SESSION['id_usuario'])) {
    try {
        // Consulta para obtener el nombre del usuario
        $stmt_usuario = $base_de_datos->prepare("SELECT usuario FROM usuario WHERE id_usuario = :id_usuario");
        $stmt_usuario->bindParam(':id_usuario', $_SESSION['id_usuario']);
        $stmt_usuario->execute();
        $usuario_data = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

        // Si se encontró el usuario, establecemos que está logueado
        if ($usuario_data) {
            $usuario_iniciado = true;
            $nombre_usuario = $usuario_data['usuario'];
        }
    } catch (PDOException $e) {
        echo "Error al consultar la base de datos: " . $e->getMessage();
        exit;
    }
}

// Obtener el id_oferta_empleo de la URL
$id_oferta_empleo = isset($_GET['id_oferta_empleo']) ? intval($_GET['id_oferta_empleo']) : '';

if (!empty($id_oferta_empleo)) {
    try {
        // Preparar la consulta para la oferta de empleo
        $stmt = $base_de_datos->prepare("SELECT titulo_emp FROM oferta_empleo WHERE id_oferta_empleo = :id");
        $stmt->bindParam(':id', $id_oferta_empleo, PDO::PARAM_INT);
        $stmt->execute();
        $oferta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$oferta) {
            echo "Oferta no encontrada.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error al consultar la base de datos: " . $e->getMessage();
        exit;
    }
} else {
    echo "ID no válido.";
    exit;
}

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calificacion = isset($_POST['calificacion']) ? intval($_POST['calificacion']) : 0;
    $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
    $fecha = date('Y-m-d'); // Obtener la fecha actual en formato YYYY-MM-DD

    if ($usuario_iniciado && !empty($calificacion) && !empty($comentario) && $calificacion >= 1 && $calificacion <= 5) {
        try {
            // Insertar la reseña en la base de datos
            $stmt_insert = $base_de_datos->prepare("INSERT INTO calificaciones (calificacion, comentario, oferta_empleo_id_oferta_empleo, fecha, usuario_id_usuario) VALUES (:calificacion, :comentario, :oferta_empleo_id_oferta_empleo, :fecha, :usuario_id_usuario)");
            $stmt_insert->bindParam(':calificacion', $calificacion, PDO::PARAM_INT);
            $stmt_insert->bindParam(':comentario', $comentario, PDO::PARAM_STR);
            $stmt_insert->bindParam(':oferta_empleo_id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);
            $stmt_insert->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt_insert->bindParam(':usuario_id_usuario', $_SESSION['id_usuario'], PDO::PARAM_INT);
            $stmt_insert->execute();

            // Redirigir a la página de detalles de la oferta de empleo
            header("Location: detalleempleo.php?id=$id_oferta_empleo");
            exit;
        } catch (PDOException $e) {
            echo "Error al insertar la reseña: " . $e->getMessage();
            exit;
        }
    } else {
        echo "Por favor completa todos los campos y proporciona una calificación válida (1-5).";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dejar Reseña - <?php echo htmlspecialchars($oferta['titulo_emp']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header {
            background-color: #6a0dad;
            padding: 20px;
            text-align: center;
            color: white;
        }
        .header-container img {
            max-height: 50px;
        }
        .header-container .user-info {
            margin-top: 10px;
        }
        .header-container .user-info span {
            color: #fff;
            margin-right: 20px;
        }
        .header-container .user-info .btn-lil {
            background-color: #4b0082;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .stars {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .stars i {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        .stars i.filled {
            color: #ffd700;
        }
        .submit-btn {
            background-color: #6a0dad;
            color: white;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #4b0082;
        }
    </style>
    <script>
        // Función para seleccionar estrellas y enviar calificación
        function calificar(valor) {
            const estrellas = document.querySelectorAll('.stars i');
            estrellas.forEach((estrella, index) => {
                estrella.classList.toggle('filled', index < valor);
            });
            document.getElementById('calificacion').value = valor;
        }
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="./imagenes/logoTotal.png" alt="Logo" class="logo">
            <div class="user-info">
                <?php if ($usuario_iniciado): ?>
                    <span>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></span>
                    <button class="btn-lil" onclick="location.href='logout.php'">Cerrar sesión</button>
                <?php else: ?>
                    <button class="btn-lil" onclick="location.href='login.php'">Iniciar sesión</button>
                    <button class="btn-lil" onclick="location.href='registro.php'">Registrarse</button>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <section class="container">
        <h1>Dejar una Reseña para "<?php echo htmlspecialchars($oferta['titulo_emp']); ?>"</h1>

        <form method="POST">
            <div class="form-group">
                <label>Calificación (1-5):</label>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star" onclick="calificar(<?php echo $i; ?>)"></i>
                    <?php endfor; ?>
                </div>
                <input type="hidden" id="calificacion" name="calificacion" value="0" required>
            </div>

            <div class="form-group">
                <label for="comentario">Comentario:</label>
                <textarea id="comentario" name="comentario" rows="5" required placeholder="Escribe tu comentario aquí..."></textarea>
            </div>

            <button type="submit" class="submit-btn">Enviar Reseña</button>
        </form>
    </section>
</body>
</html>