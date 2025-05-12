<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Empleados</title>
    <link rel="stylesheet" href="admini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="inicio-header">
        <div class="container">
            <img src="imagenes/logoTotal.png" alt="Logo" class="logo">
            <nav class="nav-center">
                <button class="btn-lila" onclick="showPage('inicio')">Inicio</button>
            </nav>
            <div class="user-icon-container">
                <button class="user-icon-btn">
                    <i class="fa fa-bars user-icon"></i>
                </button>
            </div>
        </div>
    </header>

  <aside class="fixed-sidebar">
    <a href="categoria.php">Página 1</a>
    <a href="subcat.php">Página 2</a>
    <a href="pagina3.php">Página 3</a>
</aside>

<main>
    <section id="inicio">
        <h1>Inicio</h1>
        <p>Contenido de Inicio</p>
    </section>
    <section id="usuarios" style="display: none;">
        <h1>Usuarios</h1>
        <p>Contenido de Usuarios</p>
    </section>
    <section id="empresas" style="display: none;">
        <h1>Empresas</h1>
        <p>Contenido de Empresas</p>
    </section>
    <!-- Agrega el resto de las secciones aquí -->
</main>

 
</main>

    <script src="adm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-p5ZtP6d82O5FgrXfxDDK7rNEA2EOVO5mU5d5EJ8ZsE9p72P9O5wD8vP5K+P4nZ/5" crossorigin="anonymous"></script>
</body>
</html>
