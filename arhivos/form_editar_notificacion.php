<?php
include('../../conexion.php');

// Verificar si se pasó un ID válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../notificaciones.php");
    exit;
}

$id = $_GET['id'];

// Obtener datos de la notificación
$query = "SELECT * FROM notificaciones WHERE idnotificaciones = ?";
$stmt = $base_de_datos->prepare($query);
$stmt->execute([$id]);
$notificacion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$notificacion) {
    echo "Notificación no encontrada.";
    exit;
}

// Obtener usuarios para el dropdown
$queryUsuarios = "SELECT id_usuario, usuario FROM usuario";
$stmtUsuarios = $base_de_datos->prepare($queryUsuarios);
$stmtUsuarios->execute();
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Notificación - EmpleoTotal</title>
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

        <h2>Editar Notificación</h2>
        <form action="actualizar_notificacion.php" method="POST">
            <input type="hidden" name="idnotificaciones" value="<?= $notificacion['idnotificaciones'] ?>">

            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea id="contenido" name="contenido" rows="4" required><?= htmlspecialchars($notificacion['contenido']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_envio">Fecha de Envío</label>
                <input type="date" id="fecha_envio" name="fecha_envio" value="<?= $notificacion['fecha_envio'] ?>" required>
            </div>

            <div class="form-group">
                <label for="usuario_id_usuario">Usuario</label>
                <select id="usuario_id_usuario" name="usuario_id_usuario" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id_usuario'] ?>" <?= $usuario['id_usuario'] == $notificacion['usuario_id_usuario'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($usuario['usuario']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-agregar">Actualizar Notificación</button>
        </form>
    </div>
</div>

</body>
</html>
