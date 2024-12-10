<?php
// Iniciar la sesión
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Renovada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/pedro.css">
</head>
<body>
    <!-- Header -->
    <header class="custom-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo-container">
                <img src="img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
            </div>
            <nav>
                <button class="btn btn-secondary">
                    <a href="index.php" class="nav-link">Volver</a>
                </button>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mt-5 text-center">
        <h1 class="text-gradient">Bienvenido a nuestra plataforma</h1>
        <p class="mt-3">Explora las herramientas que tenemos para ofrecerte.</p>

        <!-- Sección Cards -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="img/wcuenta_xl.png" class="card-img-top" alt="Tutoriales">
                    <div class="card-body">
                        <h5 class="card-title">Tutoriales</h5>
                        <p class="card-text">Aprende a usar nuestras herramientas con guías paso a paso.</p>
                        <a href="asistencia.php" class="btn btn-primary">Explorar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="img/olakhace.jpg" class="card-img-top" alt="Preguntas Frecuentes">
                    <div class="card-body">
                        <h5 class="card-title">Preguntas Frecuentes</h5>
                        <p class="card-text">Encuentra respuestas rápidas a tus dudas más comunes.</p>
                        <a href="descripcion.php" class="btn btn-secondary">Consultar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="img/98ec292dc3fbf42c55fe2e7de48b7b36.jpg" class="card-img-top" alt="Soporte">
                    <div class="card-body">
                        <h5 class="card-title">Soporte Técnico</h5>
                        <p class="card-text">Nuestro equipo está listo para asistirte en todo momento.</p>
                        <a href="asistencias.php" class="btn btn-danger">Contactar</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-5 py-4 text-center text-dark">
        <p>&copy; 2024 Nuestra Plataforma. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
