<?php
// Guardar notificación en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../../conexion.php');

    $contenido = $_POST['contenido'];
    $fecha_envio = $_POST['fecha_envio'];
    $usuario_id = $_POST['usuario_id_usuario'];

    $query = "INSERT INTO notificaciones (contenido, fecha_envio, usuario_id_usuario) VALUES (?, ?, ?)";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$contenido, $fecha_envio, $usuario_id]);

    header("Location: ../../notificaciones_admin.php");
    exit;
}

// Obtener usuarios para el desplegable
include('../../conexion.php');
$queryUsuarios = "SELECT id_usuario, usuario FROM usuario";
$stmtUsuarios = $base_de_datos->prepare($queryUsuarios);
$stmtUsuarios->execute();
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Notificación - EmpleoTotal</title>
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

<div class="container">
    <div class="formulario">
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Agregar Notificación</h2>
        <form action="form_agregar_notificacion.php" method="POST">
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea id="contenido" name="contenido" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_envio">Fecha de Envío</label>
                <input type="date" id="fecha_envio" name="fecha_envio" required>
            </div>

            <div class="form-group">
                <label for="usuario_id_usuario">Usuario</label>
                <select id="usuario_id_usuario" name="usuario_id_usuario" required>
                    <option value="">Selecciona un usuario</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['usuario']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-agregar">Agregar Notificación</button>
        </form>
    </div>
</div>

</body>
</html>
