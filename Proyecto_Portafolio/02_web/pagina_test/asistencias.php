<?php
// Iniciar la sesión
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte Técnico</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/soporte-tecnico.css">
</head>
<body>
<header class="support-header py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <img src="img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
        <button class="btn btn-secondary btn-sm" onclick="location.href='notificacionem.php'">Volver</button>
    </div>
</header>

<main class="container my-5">
    <h1 class="text-center text-gradient mb-5">Soporte Técnico</h1>
    
    <!-- Contactos principales -->
    <section class="contact-section mb-4">
        <h2 class="text-center mb-4">Contáctanos</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="contact-card">
                    <h3>Teléfono de Soporte</h3>
                    <p><strong>Horario:</strong> Lunes a Viernes, 9:00 AM - 6:00 PM</p>
                    <p><i class="fa fa-phone"></i> +52 55 1234 5678</p>
                    <p><i class="fa fa-phone"></i> +52 81 8765 4321 (Monterrey)</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h3>Correos Electrónicos</h3>
                    <p><i class="fa fa-envelope"></i> soporte@miempresa.com</p>
                    <p><i class="fa fa-envelope"></i> atencion@miempresa.com</p>
                    <p><strong>Respuesta:</strong> 24 a 48 horas hábiles</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Redes sociales -->
    <section class="contact-section mb-4">
    <h2 class="text-center mb-4">Redes Sociales</h2>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="social-card text-center">
                <i class="fa fa-facebook-square fa-3x social-icon"></i>
                <h4>Facebook</h4>
                <p><a href="https://facebook.com/miempresa" target="_blank">/miempresa</a></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="social-card text-center">
                <i class="fa fa-twitter-square fa-3x social-icon"></i>
                <h4>Twitter</h4>
                <p><a href="https://twitter.com/miempresa" target="_blank">@miempresa</a></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="social-card text-center">
                <i class="fa fa-instagram fa-3x social-icon"></i>
                <h4>Instagram</h4>
                <p><a href="https://instagram.com/miempresa" target="_blank">@miempresa</a></p>
            </div>
        </div>
    </div>
</section>

</main>

<footer class="mt-5 py-4 text-center text-dark">
        <p>&copy; 2024 Nuestra Plataforma. Todos los derechos reservados.</p>
    </footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
