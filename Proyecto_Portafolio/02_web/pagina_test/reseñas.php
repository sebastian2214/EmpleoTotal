<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'empleototal';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit;
}

// Inicializar la variable $usuario_iniciado como false
$usuario_iniciado = false;
$nombre_usuario = '';

// Verificar si el usuario está logueado
session_start();
if (isset($_SESSION['id_usuario'])) {
    try {
        // Consulta para obtener el nombre del usuario
        $stmt_usuario = $pdo->prepare("SELECT usuario FROM usuario WHERE id_usuario = :id_usuario");
        $stmt_usuario->bindParam(':id_usuario', $_SESSION['id_usuario']);
        $stmt_usuario->execute();
        $usuario_data = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

        // Si se encontró el usuario, establecemos que está logueado
        if ($usuario_data) {
            $usuario_iniciado = true;
            $nombre_usuario = $usuario_data['usuario'];
        }
    } catch (PDOException $e) {
        echo 'Error al consultar la base de datos: ' . $e->getMessage();
        exit;
    }
}

// Obtener el ID de la oferta de empleo desde la URL
$id_oferta_empleo = $_GET['id_oferta_empleo'] ?? null;

if ($id_oferta_empleo) {
    try {
        // Consulta para obtener reseñas
        $query = "SELECT r.calificacion, r.comentario, r.fecha, u.usuario 
                  FROM calificaciones r
                  JOIN usuario u ON r.usuario_id_usuario = u.id_usuario
                  WHERE r.oferta_empleo_id_oferta_empleo = :id_oferta_empleo";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);
        $stmt->execute();
        $reseñas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        $reseñas = [];
    }
} else {
    $reseñas = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas del Empleo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="reseñas.css">
</head>
<body>
<header>
        <div class="container header-container">
            <img src="./imagenes/logoTotal.png" alt="Logo" class="logo">
            <div class="nav-buttons">
                <?php if ($usuario_iniciado): ?>
                    <span>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></span>
                <?php else: ?>
                    <button class="btn-lila" onclick="location.href='login.php'">Iniciar sesión</button>
                    <button class="btn-lila" onclick="location.href='registro.php'">Registrarse</button>
                <?php endif; ?>
                <button class="btn-lila" onclick="location.href='./empresas.php'">Empresa en específico</button>
                <button class="btn-lila" onclick="location.href='./inicio.php'">Volver a Inicio</button>
            </div>
        </div>
    </header>

    <section>
        <article class="reviews-container">
            <?php foreach ($reseñas as $reseña): ?>
                <div class="review">
                    <h3><?php echo htmlspecialchars($reseña['usuario']); ?></h3>
                    <div class="stars">
                        <?php 
                        $calificacion = $reseña['calificacion'];
                        for ($i = 1; $i <= 5; $i++): 
                            $class = $i <= $calificacion ? 'active' : '';
                        ?>
                            <span class="star <?php echo $class; ?>">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p><?php echo htmlspecialchars($reseña['comentario']); ?></p>
                    <span>Fecha: <?php echo htmlspecialchars($reseña['fecha']); ?></span>
                </div>
            <?php endforeach; ?>
        </article>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
