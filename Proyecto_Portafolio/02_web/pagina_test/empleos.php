<?php
// Configura la conexión a la base de datos
require 'conexion.php'; // Asegúrate de que este archivo contiene la configuración correcta de PDO

// Consulta para obtener las ofertas de empleo
$sql = "SELECT id_oferta_empleo, titulo_emp, ubicacion, descripcion FROM oferta_empleo";
$stmt = $base_de_datos->prepare($sql);
$stmt->execute();

// Obtén los resultados
$empleos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Empleos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./empleoss.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <img src="./imagenes/logoTotal.png" alt="Logo" class="logo">
        <div class="nav-buttons">
            <a href="./inicio.php" class="nav-btn">Inicio</a>
            <a href="./notificaciones.php" class="nav-btn">Notificaciones</a>
            <a href="./mensaje.php" class="nav-btn">Chat</a>
        </div>
    </header>

    <div class="search-container container">
        <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar trabajos...">
            <button class="btn btn-primary" onclick="filterJobs()">Buscar</button>
        </div>
        <div id="noResults" style="display: none;">No se encontraron resultados.</div>
    </div>

    <section class="job-list mt-5 pt-3">
        <div class="container" id="jobList">
            <?php foreach ($empleos as $empleo): ?>
                <article class="job-card card mb-4">
                    <div class="card-body">
                        <div class="job-card-header d-flex justify-content-between align-items-center">
                            <h2 class="card-title h5"><?php echo htmlspecialchars($empleo['titulo_emp']); ?></h2>
                            <span class="location-badge"><?php echo htmlspecialchars($empleo['ubicacion']); ?></span>
                        </div>
                        <p class="job-description"><?php echo htmlspecialchars($empleo['descripcion']); ?></p>
                        <a href="detalleempleo.php?id=<?php echo $empleo['id_oferta_empleo']; ?>" class="btn btn-success apply-button">Ver mas </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        function filterJobs() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const jobList = document.getElementById('jobList');
            const cards = jobList.getElementsByClassName('job-card');
            let noResults = true;

            for (let i = 0; i < cards.length; i++) {
                const title = cards[i].getElementsByClassName('card-title')[0].innerText.toLowerCase();
                const description = cards[i].getElementsByClassName('job-description')[0].innerText.toLowerCase();
                if (title.includes(input) || description.includes(input)) {
                    cards[i].style.display = '';
                    noResults = false;
                } else {
                    cards[i].style.display = 'none';
                }
            }

            document.getElementById('noResults').style.display = noResults ? 'block' : 'none';
        }
    </script>
</body>
</html>
