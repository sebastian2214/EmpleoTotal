<?php
// Iniciar la sesión
session_start();

// Tu código PHP aquí (verificar sesión, cargar datos, etc.)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Publicación de Empleo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form.css"> 
</head>
<body>
    <header>
        <div class="arroz">
            <img src="img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
            <div class="user-icons">
            <button class="btn btn-lila me-2" onclick="location.href='index.php'">Volver</button>
            </div>
        </div>
    </header>
    
    <section class="form-container container my-5">
        <h2 class="text-center">Publicar una Oferta de Empleo</h2>
        <form action="registrarPersona.php" method="post" class="row g-3" enctype="multipart/form-data">
            <div class="form-group col-12 col-md-6">
                <label for="titulo_emp">Título de empleo:</label>
                <input type="text" id="titulo_emp" name="titulo_emp" placeholder="Ingresa el título de la oferta" required class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="oferta_empleocol">Imagen de la oferta (opcional):</label>
                <input type="file" id="oferta_empleocol" name="imagen" accept="image/*" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="descripcion">Descripción del Puesto:</label>
                <textarea id="descripcion" name="descripcion" placeholder="Describe el puesto y las responsabilidades" required class="form-control"></textarea>
            </div>
            <div class="form-group col-12">
                <label for="requisitos">Requisitos del Puesto:</label>
                <textarea id="requisitos" name="requisitos" placeholder="Lista los requisitos necesarios para el puesto" required class="form-control"></textarea>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="ubicacion">Ubicación del Trabajo:</label>
                <input type="text" id="ubicacion" name="ubicacion" placeholder="Ingresa la ubicación del trabajo" required class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="salario">Rango Salarial:</label>
                <input type="text" id="salario" name="salario" placeholder="Ingresa el rango salarial (opcional)" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="telefono">Teléfono:</label>
                <input type="number" id="telefono" name="telefono" placeholder="Ingresa el teléfono de contacto" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" placeholder="Ingresa el correo de contacto" class="form-control">
            </div>

            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root"; // Usuario por defecto de MySQL en XAMPP
            $password = ""; // Dejar vacío si no has asignado una contraseña
            $dbname = "empleototal"; // El nombre de tu base de datos

            // Crear la conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }
            ?>

            <div class="form-group col-12 col-md-6">
                <label for="sub_cat">Sub Categoría:</label>
                <select name="sub_cat_id_sub_cat" required class="form-select">
                    <?php
                    // Consulta para obtener las subcategorías
                    $sql = "SELECT id_sub_cat, nombre_sub_cat FROM sub_cat"; // Ajusta los nombres de la tabla y columnas
                    $result = $conn->query($sql);

                    // Verificar si se obtienen resultados
                    if ($result->num_rows > 0) {
                        // Mostrar cada subcategoría como una opción en el select
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id_sub_cat"] . "'>" . $row["nombre_sub_cat"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay subcategorías disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <?php
            // Cerrar la conexión
            $conn->close();
            ?>

            <div class="col-12">
                <button type="submit" class="submit-button btn btn-primary w-100">Publicar Empleo</button>
            </div>
        </form>
    </section>

    <footer>
    <div class="container text-center">
        <p>&copy; 2024 Tu Empresa Empleo Total Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>

