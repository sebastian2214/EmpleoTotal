<?php
// Agregar calificación en la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('../../conexion.php');

    // Obtener los datos del formulario
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha'];
    $oferta_empleo_id_oferta_empleo = $_POST['oferta_empleo_id_oferta_empleo'];
    $usuario_id_usuario = $_POST['usuario_id_usuario'];

    // Insertar la nueva calificación en la base de datos
    $query = "INSERT INTO calificaciones (calificacion, comentario, fecha, oferta_empleo_id_oferta_empleo, usuario_id_usuario) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$calificacion, $comentario, $fecha, $oferta_empleo_id_oferta_empleo, $usuario_id_usuario]);

    // Redirigir al listado de calificaciones después de agregar
    header("Location: calificaciones.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Calificación - EmpleoTotal</title>
    <link rel="stylesheet" href="../../estilos/form_estilos.css">
    <style>
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        color: #333;
    }
    .form-group textarea:focus {
        border-color: #6C3483;
        outline: none;
    }
    </style>
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

    <!-- Formulario de agregar calificación -->
    <div class="formulario">
        <!-- Logo en la esquina derecha dentro del formulario -->
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Agregar Nueva Calificación</h2>
        <form action="guardar_calificacion.php" method="POST">
            <div class="form-group">
                <label for="calificacion">Calificación</label>
                <input type="number" id="calificacion" name="calificacion" required min="1" max="5">
            </div>
            <div class="form-group">
                <label for="comentario">Comentario</label>
                <textarea id="comentario" name="comentario" required></textarea>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="oferta_empleo_id_oferta_empleo">Oferta de Empleo</label>
                <select id="oferta_empleo_id_oferta_empleo" name="oferta_empleo_id_oferta_empleo" required>
                    <?php
                    include('../../conexion.php');
                    $query = "SELECT id_oferta_empleo, titulo_emp FROM oferta_empleo";
                    $stmt = $base_de_datos->prepare($query);
                    $stmt->execute();
                    $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($ofertas as $oferta) {
                        echo "<option value='" . $oferta['id_oferta_empleo'] . "'>" . $oferta['titulo_emp'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="usuario_id_usuario">Usuario</label>
                <select id="usuario_id_usuario" name="usuario_id_usuario" required>
                    <?php
                    $query = "SELECT id_usuario, usuario FROM usuario WHERE rol_id_rol = 3";
                    $stmt = $base_de_datos->prepare($query);
                    $stmt->execute();
                    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($usuarios as $usuario) {
                        echo "<option value='" . $usuario['id_usuario'] . "'>" . $usuario['usuario'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn-agregar">Agregar Calificación</button>
        </form>
    </div>

</div>

</body>
</html>
