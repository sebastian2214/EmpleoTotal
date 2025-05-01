<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario por defecto de MySQL en XAMPP
$password = ""; // Dejar vacío si no has asignado una contraseña
$dbname = "empleototal"; // El nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    die("No se encontró información del usuario. Por favor, inicie sesión.");
}

// Obtener el nombre de la empresa asociada al usuario autenticado
$id_usuario = $_SESSION['id_usuario'];
$sql_empresa = "SELECT nombre_emp FROM empresas WHERE usuario_id_usuario = ?";
$stmt = $conn->prepare($sql_empresa);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result_empresa = $stmt->get_result();

if ($result_empresa->num_rows > 0) {
    $empresa = $result_empresa->fetch_assoc();
    $nombre_empresa = $empresa['nombre_emp'];
} else {
    $nombre_empresa = "No se encontró empresa asociada";
}
$stmt->close();
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
            <div class="form-group col-12">
                <label for="empresa">Empresa:</label>
                <input 
                    type="text" 
                    id="empresa" 
                    name="empresa" 
                    value="<?php echo htmlspecialchars($nombre_empresa); ?>" 
                    readonly 
                    class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="titulo_emp">Título de empleo:</label>
                <input 
                    type="text" 
                    id="titulo_emp" 
                    name="titulo_emp" 
                    placeholder="Ingresa el título de la oferta" 
                    required 
                    class="form-control"
                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                    title="Solo se permiten letras y espacios">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="oferta_empleocol">Imagen de la oferta (opcional):</label>
                <input 
                    type="file" 
                    id="oferta_empleocol" 
                    name="imagen" 
                    accept="image/*" 
                    class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="descripcion">Descripción del Puesto:</label>
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    placeholder="Describe el puesto y las responsabilidades" 
                    required 
                    class="form-control"
                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                    title="Solo se permiten letras y espacios"></textarea>
            </div>
            <div class="form-group col-12">
                <label for="requisitos">Requisitos del Puesto:</label>
                <textarea 
                    id="requisitos" 
                    name="requisitos" 
                    placeholder="Lista los requisitos necesarios para el puesto" 
                    required 
                    class="form-control"
                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" 
                    title="Solo se permiten letras y espacios"></textarea>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="ubicacion">Ubicación del Trabajo:</label>
                <input 
                    type="text" 
                    id="ubicacion" 
                    name="ubicacion" 
                    placeholder="Ingresa la ubicación del trabajo" 
                    required 
                    class="form-control"
                    title="Solo se permiten letras y espacios">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="salario">Rango Salarial:</label>
                <input 
                    type="number" 
                    id="salario" 
                    name="salario" 
                    placeholder="Ingresa el rango salarial (opcional)" 
                    class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="telefono">Teléfono:</label>
                <input 
                    type="number" 
                    id="telefono" 
                    name="telefono" 
                    placeholder="Ingresa el teléfono de contacto" 
                    class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="correo">Correo:</label>
                <input 
                    type="email" 
                    id="correo" 
                    name="correo" 
                    placeholder="Ingresa el correo de contacto" 
                    class="form-control">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="sub_cat">Sub Categoría:</label>
                <select 
                    name="sub_cat_id_sub_cat" 
                    required 
                    class="form-select">
                    <?php
                    // Consulta para obtener las subcategorías
                    $sql_subcat = "SELECT id_sub_cat, nombre_sub_cat FROM sub_cat";
                    $result_subcat = $conn->query($sql_subcat);

                    if ($result_subcat->num_rows > 0) {
                        while ($row = $result_subcat->fetch_assoc()) {
                            echo "<option value='" . $row["id_sub_cat"] . "'>" . $row["nombre_sub_cat"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay subcategorías disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="link_test">Test:</label>
                <input 
                    type="url" 
                    id="link_test" 
                    name="link_test" 
                    placeholder="Ingresa el link del test" 
                    required 
                    class="form-control">
            </div>
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
