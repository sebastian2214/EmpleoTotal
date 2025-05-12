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
$id_oferta_empleo = isset($_GET['id']) ? intval($_GET['id']) : '';

if (!empty($id_oferta_empleo)) {
    try {
        // Preparar la consulta para la oferta de empleo
        $stmt = $base_de_datos->prepare("SELECT * FROM oferta_empleo WHERE id_oferta_empleo = :id");
        $stmt->bindParam(':id', $id_oferta_empleo, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si la oferta existe
        $oferta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($oferta) {
            // Asignar la ruta de la imagen
            $imagen_src = !empty($oferta["oferta_empleocol"]) ? htmlspecialchars($oferta["oferta_empleocol"]) : './imagenes/LogoTotal.png';

            // Obtener calificaciones promedio
            $stmt_calificaciones = $base_de_datos->prepare("SELECT AVG(calificacion) AS promedio_calificaciones FROM calificaciones WHERE oferta_empleo_id_oferta_empleo = :id");
            $stmt_calificaciones->bindParam(':id', $id_oferta_empleo, PDO::PARAM_INT);
            $stmt_calificaciones->execute();
            $calificaciones = $stmt_calificaciones->fetch(PDO::FETCH_ASSOC);
            $promedio_calificaciones = $calificaciones['promedio_calificaciones'] ?? 0;

        } else {
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($oferta['titulo_emp']); ?> - Detalles</title>
    <link rel="stylesheet" href="css/detalleempleos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Añade aquí tus estilos personalizados */
        .container {
            padding: 20px;
        }
        .card {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 150px;
        }
        .btn-lil {
            background-color: #6a0dad;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
            border-radius: 5px;
        }
        .btn-lil:hover {
            background-color: #4b0082;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .ratings .stars i {
            color: #ffd700;
            margin-right: 5px;
        }
        .ratings .stars i.filled {
            color: #ffd700;
        }
        .apply-btn {
            display: block;
            width: 100%;
            background-color: #6a0dad;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
        .apply-btn:hover {
            background-color: #4b0082;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="./imagenes/logoTotal.png" alt="Logo" class="logo">

            <div class="user-info">
                <?php if ($usuario_iniciado): ?>
             
                    <button class="btn-lila" onclick="location.href='./inicio.php'">Volver a inicio</button>
                <?php else: ?>
                    <button class="btn-lil" onclick="location.href='login.php'">Iniciar sesión</button>
                    <button class="btn-lil" onclick="location.href='registro.php'">Registrarse</button>
                <?php endif; ?>
            </div>
            
        </div>
    </header>

    <section class="container">
        <section class="userProfile card">
            <div class="profile">
                <figure>
                    <img src="<?php echo $imagen_src; ?>" alt="Imagen de la empresa">
                </figure>
            </div>
        </section>

        <section class="work_skills card">
            <div class="work">
                <h1 class="heading">Ubicación</h1>
                <div class="primary">
                    <h2><?php echo htmlspecialchars($oferta['ubicacion']); ?></h2>
                </div>
            </div>
            <div class="skills">
                <h1 class="heading">Requisitos</h1>
                <ul>
                    <li><?php echo nl2br(htmlspecialchars($oferta['requisitos'])); ?></li>
                </ul>
            </div>
        </section>

        <section class="userDetails card">
            <div class="userName">
                <h1 class="name"><?php echo htmlspecialchars($oferta['titulo_emp']); ?></h1>
                <div class="map">
                    <i class="fas fa-map-pin"></i>
                    <span><?php echo htmlspecialchars($oferta['ubicacion']); ?></span>
                </div>
                <p><?php echo htmlspecialchars($oferta['descripcion']); ?></p>
            </div>
            <div class="rank">
                <h1 class="heading">Salario</h1>
                <div><?php echo htmlspecialchars($oferta['salario']); ?> COP</div>
            </div>
        </section>

        <section class="contact_Info card">
            <h1 class="heading">Información de Contacto</h1>
            <ul>
                <li class="phone">
                    <h2 class="label">Teléfono:</h2>
                    <span class="info"><?php echo htmlspecialchars($oferta['telefono']); ?></span>
                </li>
                <li class="email">
                    <h2 class="label">E-mail:</h2>
                    <span class="info"><?php echo htmlspecialchars($oferta['correo']); ?></span>
                </li>
            </ul>
        </section>

        <section class="basic_info card">
            <h1 class="heading">Descripción del Empleo</h1>
            <p><?php echo htmlspecialchars($oferta['descripcion']); ?></p>
        </section>

        <!-- Sección para mostrar las estrellas de calificación -->
        <section class="ratings card">
            <h1 class="heading">Calificaciones</h1>
            <div class="stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-star <?php echo $i <= round($promedio_calificaciones) ? 'filled' : ''; ?>"></i>
                <?php endfor; ?>
            </div>
            <p>Promedio: <?php echo number_format($promedio_calificaciones, 1); ?> estrellas</p>
        </section>

        <!-- Botones para ver y dar reseñas -->
        <section class="buttons">
            <button class="btn-lil" onclick="location.href='./reseñas.php?id_oferta_empleo=<?php echo $id_oferta_empleo; ?>'">Ver Reseñas</button>
            <button class="btn-lil" onclick="location.href='./dar_reseña.php?id_oferta_empleo=<?php echo $id_oferta_empleo; ?>'">Dar Reseña</button>
            <button class="apply-btn" onclick="location.href='./test.php?id_oferta_empleo=<?php echo $id_oferta_empleo; ?>'">Realizar Test</button>
        </section>
        
        <?php if ($usuario_iniciado): ?>
            <!-- Botón de aplicar -->
            <button type="button" class="btn-lil" data-toggle="modal" data-target="#applyModal">Aplicar para esta oferta</button>
        <?php endif; ?>

        <!-- Modal de Bootstrap -->
        <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel">Confirmar Aplicación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro que deseas aplicar para esta oferta? Debes realizar un test antes de aplicar de lo contrario seras menos recomendado,<br> si ya hiciste el test puedes aplicar con normalidad</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="applyJob()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
<!-- El formulario de aplicar (invisible hasta que el usuario confirme) -->
        <form id="applyForm" method="post" action="aplicar.php" style="display: none;">
            <input type="hidden" name="id_oferta_empleo" value="<?php echo $id_oferta_empleo; ?>">
        </form>
    </section>
    

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Función para aplicar al empleo
        function applyJob() {
            // Enviar el formulario de aplicación
            document.getElementById("applyForm").submit();
        }
    </script>
</body>
</html>
