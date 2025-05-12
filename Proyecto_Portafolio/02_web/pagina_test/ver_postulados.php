<?php
// Iniciar sesión
session_start();

// Verificar si se recibió el ID de la oferta de empleo
if (!isset($_GET['id_oferta_empleo']) || !is_numeric($_GET['id_oferta_empleo'])) {
    echo "No se especificó o el ID de la oferta de empleo es inválido.";
    exit;
}

// Incluir la conexión a la base de datos
include_once "conexion.php";

// Si se recibe una acción para aceptar o rechazar
if (isset($_POST['accion']) && isset($_POST['id_postulado'])) {
    $id_postulado = intval($_POST['id_postulado']);
    $accion = $_POST['accion'];

    // Validar que la acción sea 'aceptado' o 'rechazado'
    if (in_array($accion, ['aceptado', 'rechazado'])) {
        try {
            // Actualizar el estado del postulado
            $query = "
                UPDATE hojade_de_vida_has_oferta_empleo
                SET estado = :estado
                WHERE hojade_de_vida_id_hojade_de_vida = :id_postulado
                AND oferta_empleo_id_oferta_empleo = :id_oferta_empleo";
            $sentencia = $base_de_datos->prepare($query);
            $sentencia->bindParam(':estado', $accion, PDO::PARAM_STR);
            $sentencia->bindParam(':id_postulado', $id_postulado, PDO::PARAM_INT);
            $sentencia->bindParam(':id_oferta_empleo', $_GET['id_oferta_empleo'], PDO::PARAM_INT);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el estado: " . htmlspecialchars($e->getMessage());
        }
    }
}

// Obtener los datos de los postulados
try {
    $id_oferta_empleo = intval($_GET['id_oferta_empleo']);
    $query = "
        SELECT hdv.id_hojade_de_vida, hdv.nombre, hdv.apellido, hdv.direccion, hdv.telefono, 
               hdv.correo, hdv.estado_civil, hdv.fecha_nacimiento, hdv.nacionalidad, 
               hdv.descripcion_sobre_ti, hdv.objetivo_profecional, hdv.idiomas, hdv.referencias, 
               hdv.parentezco, hdv.numero_referencia, hdv.intereses_personales, 
               hdv.disponibilidad_trabajo, hdoe.estado
        FROM hojade_de_vida_has_oferta_empleo hdoe
        INNER JOIN hojade_de_vida hdv ON hdoe.hojade_de_vida_id_hojade_de_vida = hdv.id_hojade_de_vida
        WHERE hdoe.oferta_empleo_id_oferta_empleo = :id_oferta_empleo";
    
    $sentencia = $base_de_datos->prepare($query);
    $sentencia->bindParam(':id_oferta_empleo', $id_oferta_empleo, PDO::PARAM_INT);
    $sentencia->execute();
    $postulados = $sentencia->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error al recuperar los datos: " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulados a la Oferta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/php.css">
</head>
<body>
<header>
    <div class="container">
        <img src="./img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
        <div class="user-icons">
            <button class="btn-lila" onclick="location.href='./mostrar_datos.php'">Volver</button>
        </div>
    </div>
</header>

<div class="container mt-4">
    <h1 class="text-center">Postulados a la Oferta</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Estado Civil</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Nacionalidad</th>
                    <th>Idiomas</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($postulados)): ?>
                    <?php foreach ($postulados as $postulado): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($postulado->nombre); ?></td>
                            <td><?php echo htmlspecialchars($postulado->apellido); ?></td>
                            <td><?php echo htmlspecialchars($postulado->telefono); ?></td>
                            <td><?php echo htmlspecialchars($postulado->correo); ?></td>
                            <td><?php echo htmlspecialchars($postulado->direccion); ?></td>
                            <td><?php echo htmlspecialchars($postulado->estado_civil); ?></td>
                            <td><?php echo htmlspecialchars($postulado->fecha_nacimiento); ?></td>
                            <td><?php echo htmlspecialchars($postulado->nacionalidad); ?></td>
                            <td><?php echo htmlspecialchars($postulado->idiomas); ?></td>
                            <td>
                                <span class="badge <?php echo ($postulado->estado == 'aceptado') ? 'bg-success' : (($postulado->estado == 'rechazado') ? 'bg-danger' : 'bg-warning'); ?>">
                                    <?php echo ucfirst($postulado->estado); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($postulado->estado == 'pendiente'): ?>
                                    <form action="" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_postulado" value="<?php echo $postulado->id_hojade_de_vida; ?>">
                                        <input type="hidden" name="accion" value="aceptado">
                                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                    </form>
                                    <form action="" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_postulado" value="<?php echo $postulado->id_hojade_de_vida; ?>">
                                        <input type="hidden" name="accion" value="rechazado">
                                        <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Acción no disponible</button>
                                <?php endif; ?>
                                <!-- Botón para ver detalles -->
                                <a href="ver_detalle.php?id_postulado=<?php echo $postulado->id_hojade_de_vida; ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">No hay postulados para esta oferta.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
