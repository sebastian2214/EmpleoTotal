<?php
// Start session
session_start();

// Include database connection
require 'conexion.php'; 

// Check if user is authenticated
if (!isset($_SESSION['id_usuario'])) {
    header('Location: Inicio_Sesion.php'); // Redirect to login page if not authenticated
    exit;
}

// Get user data
$id_usuario = $_SESSION['id_usuario'];
$stmt = $base_de_datos->prepare("SELECT usuario FROM usuario WHERE id_usuario = :id");
$stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Stile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
<header>
    <div class="container">
        <img src="./imagenes/WhatsApp_Image_2024-05-19_at_7.50.52_PM-removebg-preview.png" alt="Logo" class="logo">
        <div class="user-icons">
            <button class="btn-lila" onclick="location.href='./mensajes.php'">Chat</button>
            <button class="btn-lila position-relative" onclick="location.href='./informacion.php'">
                
                Informacion
                <!-- Indicador de notificaciones -->
            </button>
            <button class="user-icon-btn" onclick="toggleSidebar()">
                <i class="fa fa-bars user-icon"></i>
            </button>
        </div>
    </div>
</header>

<nav id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
    <div class="sidebar-content">
        <?php
        // Si no existe imagen de perfil o es un valor vacío, asignar una imagen por defecto
        $imagenPerfil = !empty($usuario['imagen_perfil']) ? $usuario['imagen_perfil'] : 'imagenes/user.jfif';
        ?>
        <img src="<?php echo htmlspecialchars($imagenPerfil); ?>" alt="Imagen de Perfil" class="profile-image">
        <h2><?php echo htmlspecialchars($usuario['usuario']); ?></h2>
        <a href="./mostrar_datos.php">Ofertas</a>
        <a href="./notificacionem.php">Asistencia</a>


        <?php if (isset($_SESSION['usuario'])): ?>
            <!-- Mostrar botón de "Cerrar Sesión" -->
            <a href="./logout.php"><button class="btn-cerrar-sesion">Cerrar Sesión</button></a>
        <?php else: ?>
            <!-- Mostrar botón de "Iniciar Sesión" si no está autenticado -->
            <a href="./Inicio_Sesion.html"><button class="btn-inicio-sesion">Iniciar Sesión</button></a>
        <?php endif; ?>
    </div>
</nav>
<div id="overlay" class="overlay" onclick="closeSidebar()"></div>
    <!-- Header Section (Mantiene tu barra de menú original) -->
   
    
    <!-- Main Content Section -->
    <main>
        <!-- Banner Section -->
        <section class="banner text-white text-center d-flex align-items-center justify-content-center" style="min-height: 300px; background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('css/R.jpg'); background-size: cover; background-position: center;">
            <div class="container">
              <h2 class="display-4">100% Confiable <br />Muchas Categorías</h2>
              <p class="lead">Encuentra tu próximo empleado acá</p>
            </div>
          </section>
          
        
    
        <!-- Steps Section -->
        <section class="steps py-5 bg-light">
            <div class="container">
                <div class="conteiner mb-5">
                    
                    
                <div class="container mt-1 text-center">


    <!-- Botones y descripción -->
    <div class="d-flex align-items-center justify-content-center">
        <!-- Botón izquierdo -->
        <div class="text-center" style="width: 50%;">
            <a href="publicar.php" class="btn custom-btn">Publicar empleo</a>
            <p class="mt-2">Puedes iniciar publicando tu <br>
            oferta de empleo.
        </div>

        <!-- Línea divisoria -->
        <div style="border-left: 3px solid #ddd; height: 70px; margin-top:-30px;"></div>

        <!-- Botón derecho -->
        <div class="text-center" style="width: 50%;">
            <a href="buscar.php" class="btn custom-btn">Buscar empleado</a>
            <p class="mt-2">encuentra a tu siguiente empleado <br>
            segun tus necesidades.
        </div>
    </div>
</div>

        
     

                <div class="row text-center">
                    <!-- Step 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="img/wcuenta_xl.png" class="card-img-top" alt="Crear cuenta">
                            <div class="card-body">
                                <h5 class="card-title">1. Cree una cuenta</h5>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="img/publicar-oferta-de-empleo-810x455.webp" class="card-img-top" alt="Publicar oferta de empleo">
                            <div class="card-body">
                                <h5 class="card-title">2. Cree su publicación de empleo</h5>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="img/98ec292dc3fbf42c55fe2e7de48b7b36.jpg" class="card-img-top" alt="Publicar empleo">
                            <div class="card-body">
                                <h5 class="card-title">3. Publique su empleo</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
    <div class="container text-center">
        <p>&copy; 2024 Tu Empresa Empleo Total Todos los derechos reservados.</p>
    </div>
</footer>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para mostrar la alerta -->
    <script>
        function mostrarAlerta() {
            alert('Tienes una nueva solicitud de empleo. Un candidato se ha postulado.');
        }
    </script>


<script>
    // Funciones para el sidebar
    function toggleSidebar() {
        document.getElementById("sidebar").style.width = "250px";
        document.getElementById("overlay").style.display = "block";
    }

    function closeSidebar() {
        document.getElementById("sidebar").style.width = "0";
        document.getElementById("overlay").style.display = "none";
    }
</script>
</body>

</html>
