<?php
// Iniciar la sesión
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar en Empleototal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/ojala.css">
</head>
<body>
    <header class="bg-dark text-white py-3 fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
            <div class="user-icons">
                <button class="btn btn-lila me-2" onclick="location.href='index.php'">Volver</button>
                <button class="btn btn-lila" onclick="location.href='informacion.php'">Información</button>
            </div>
        </div>
    </header>

    <main class="pt-5">
        <!-- Formulario de búsqueda centrado -->
        <div class="container">
            <form action="" method="GET" class="form search-form">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Buscar en Empleototal" required>
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>

        <!-- Resultados de la búsqueda -->
        <div id="resultados" class="mt-4 table-container container">
            <?php
            if (isset($_GET['query'])) {
                $query = $_GET['query'];

                // Conexión a la base de datos
                $conn = new mysqli("localhost", "root", "", "empleototal");

                // Verifica la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta SQL para buscar en varias columnas
                $sql = "SELECT nombre, apellido, correo, telefono, idiomas, disponibilidad_trabajo FROM hojade_de_vida WHERE nombre LIKE ? OR apellido LIKE ? OR correo LIKE ? OR idiomas LIKE ?";
                $stmt = $conn->prepare($sql);
                $search = "%" . $query . "%";
                $stmt->bind_param("ssss", $search, $search, $search, $search);
                $stmt->execute();
                $result = $stmt->get_result();

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered table-hover table-striped rounded-3' style='background-color: white;'>"; 
                    echo "<thead class='thead-light'><tr><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Teléfono</th><th>Idiomas</th><th>Disponibilidad</th></tr></thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['correo'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        echo "<td>" . $row['idiomas'] . "</td>";
                        echo "<td>" . $row['disponibilidad_trabajo'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<div class='no-results'>
                            <p class='text-center'>No se encontraron resultados.</p>
                          </div>";
                }

                // Cerrar la conexión
                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
