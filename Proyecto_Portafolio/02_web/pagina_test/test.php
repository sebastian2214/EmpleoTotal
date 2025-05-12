<?php
session_start();
require 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    echo "Debes iniciar sesión para realizar el test.";
    exit;
}

$usuario_id = $_SESSION['id_usuario'];
$oferta_id = isset($_GET['id_oferta_empleo']) ? intval($_GET['id_oferta_empleo']) : 0;

if ($oferta_id <= 0) {
    echo "ID de oferta inválido.";
    exit;
}

// Obtener el link_test de la oferta
try {
    $stmt = $base_de_datos->prepare("SELECT link_test FROM oferta_empleo WHERE id_oferta_empleo = :oferta_id");
    $stmt->bindParam(':oferta_id', $oferta_id, PDO::PARAM_INT);
    $stmt->execute();
    $oferta = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$oferta || empty($oferta['link_test'])) {
        echo "No se encontró el enlace del test para esta oferta.";
        exit;
    }

    $link_test = $oferta['link_test'];
} catch (PDOException $e) {
    echo "Error al obtener el enlace del test: " . $e->getMessage();
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $resultado = htmlspecialchars($_POST['resultado']);
        $imagen_test = ''; // Ruta de la imagen, si aplica

        // Subir imagen si existe
        if (isset($_FILES['imagen_test']) && $_FILES['imagen_test']['error'] === UPLOAD_ERR_OK) {
            $imagen_dir = './uploads/';
            $imagen_nombre = basename($_FILES['imagen_test']['name']);
            $imagen_ruta = $imagen_dir . $imagen_nombre;

            // Mover archivo a la carpeta de destino
            if (move_uploaded_file($_FILES['imagen_test']['tmp_name'], $imagen_ruta)) {
                $imagen_test = $imagen_ruta;
            }
        }

        // Insertar resultado en la base de datos
        $stmt = $base_de_datos->prepare("
            INSERT INTO test_oferta (resultado, imagen_test, usuario_id, oferta_id) 
            VALUES (:resultado, :imagen_test, :usuario_id, :oferta_id)
        ");
        $stmt->bindParam(':resultado', $resultado);
        $stmt->bindParam(':imagen_test', $imagen_test);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':oferta_id', $oferta_id);
        $stmt->execute();

        echo "¡Test completado con éxito!";
        exit;
    } catch (PDOException $e) {
        echo "Error al guardar el test: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* General */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
            display: flex; /* Habilita el diseño flexible */
            align-items: center; /* Centra verticalmente */
            justify-content: center; /* Centra horizontalmente */
        }

        /* Header */
        header {
            background: linear-gradient(90deg, #2e005b, #4a007f);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            height: 80px; /* Aumenta el tamaño del logo */
        }
        header button {
            background-color: #6a0dad;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
        }
        header button:hover {
            background-color: #4b0082;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        /* Main Content */
        .container {
            max-width: 600px;
            width: 100%; /* Asegura que ocupe un ancho máximo adecuado */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Añade una sombra ligera */
        }
        .btn-submit, .btn-test {
            background-color: #6a0dad;
            color: white;
        }
        .btn-submit:hover, .btn-test:hover {
            background-color: #4b0082;
        }
        .input-group .form-control {
            max-width: 80px; /* Campo más corto */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="d-flex align-items-center">
            <img src="./img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo me-3">
            <h1 class="mb-0 fs-4">EmpleoTotal</h1>
        </div>
        <div>
            <button onclick="location.href='inicio.php'">Volver a Inicio</button>
            <button>Notificaciones</button>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            <h1 class="text-center">Realizar Test</h1>
            <!-- Botón Ir al Test -->
            <div class="text-center mb-3">
       <!-- Botón Ir al Test -->
<div class="text-center mb-3">
    <button class="btn btn-test" onclick="window.open('<?php echo htmlspecialchars($link_test); ?>', '_blank')">Ir al Test</button>
</div>

            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="resultado" class="form-label">Resultado del Test</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="resultado" name="resultado" placeholder="0" min="0" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="imagen_test" class="form-label">Subir Imagen (Obligatorio)</label>
                    <input type="file" class="form-control" id="imagen_test" name="imagen_test" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-submit w-100">Enviar Test</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
