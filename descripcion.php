<?php
// Iniciar la sesión
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/canijo.css">
</head>
<body>
<header class="faq-header py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <img src="img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
        <button class="btn btn-secondary btn-sm" onclick="location.href='notificacionem.php'">Volver</button>
    </div>
</header>

<main class="container my-5">
    <h1 class="text-center mb-4 text-gradient">Preguntas Frecuentes</h1>
    <div class="row g-4">
        <!-- Pregunta 1 -->
        <div class="col-lg-6">
            <div class="faq-card">
                <h3>¿Cómo puedo crear una cuenta?</h3>
                <p>Para crear una cuenta, haz clic en el botón de "Registrarse" en la página principal. Completa los campos con tu información personal y confirma tu correo electrónico.</p>
            </div>
        </div>
        <!-- Pregunta 2 -->
        <div class="col-lg-6">
            <div class="faq-card">
                <h3>¿Qué hago si olvidé mi contraseña?</h3>
                <p>Haz clic en "¿Olvidaste tu contraseña?" en la página de inicio de sesión. Introduce tu correo electrónico y sigue las instrucciones que recibirás para restablecerla.</p>
            </div>
        </div>
        <!-- Pregunta 3 -->
        <div class="col-lg-6">
            <div class="faq-card">
                <h3>¿Cómo subo mi currículum?</h3>
                <p>Accede a tu perfil y selecciona la opción "Subir CV". Asegúrate de que el archivo esté en formato PDF, DOC o DOCX y que no supere los 5 MB.</p>
            </div>
        </div>
        <!-- Pregunta 4 -->
        <div class="col-lg-6">
            <div class="faq-card">
                <h3>¿Por qué no puedo postularme a una oferta?</h3>
                <p>Verifica que tu perfil esté completo y que cumplas con los requisitos de la oferta. Si el problema persiste, intenta contactar al soporte técnico.</p>
            </div>
        </div>
        <!-- Pregunta 5 -->
        <div class="col-lg-6">
            <div class="faq-card">
                <h3>¿Cómo configuro alertas de empleo?</h3>
                <p>En tu perfil, selecciona "Alertas de empleo". Configura los filtros según tus intereses y guarda las preferencias. Recibirás notificaciones por correo electrónico.</p>
            </div>
        </div>
        <!-- Pregunta 6 -->
        <div class="col-lg-6">
            <div class="faq-card">
                <h3>¿Qué hago si encuentro un error en la página?</h3>
                <p>Primero, intenta actualizar tu navegador o borrar la caché y las cookies. Si el problema persiste, contacta al soporte técnico proporcionando detalles del error.</p>
            </div>
        </div>
    </div>
</main>

<footer class="mt-5 py-4 text-center text-dark">
        <p>&copy; 2024 Nuestra Plataforma. Todos los derechos reservados.</p>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
