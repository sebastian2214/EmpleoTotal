<?php
// Iniciar la sesión
session_start();

// Tu código PHP aquí (verificar sesión, cargar datos, etc.)
?>
<?php
include_once "conexion.php"; 

try {
    $sentencia = $base_de_datos->query("SELECT * FROM oferta_empleo");
    $ofertas = $sentencia->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error al recuperar los datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas de Empleo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/php.css">
</head>
<body>
<header>
        <div class="container">
            <img src="../img/Imagen_de_WhatsApp_2024-05-19_a_las_22.13.35_0c41c9e7-removebg-preview.png" alt="Logo" class="logo">
            <div class="user-icons">
                <button class="btn-lila" onclick="location.href='../notificacionem.php'">Volver</button>
                <button class="user-icon-btn" onclick="toggleSidebar()">
                    <i class="fa fa-bars user-icon"></i>
                </button>
            </div>
        </div>
    </header>

<div class="container centrar-tabla">
    <div class="table-responsive">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Requisitos</th>
                    <th>Ubicación</th>
                    <th>Salario</th>
                    <th>Imagen</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Sub Categoría</th>
                    <th>Acciones</th>
                    <th>Opción</th> <!-- Nueva columna Opción -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($ofertas as $oferta) { ?>
                <tr>
                    <td><?php echo $oferta->id_oferta_empleo; ?></td>
                    <td><?php echo $oferta->titulo_emp; ?></td>
                    <td><?php echo $oferta->descripcion; ?></td>
                    <td><?php echo $oferta->requisitos; ?></td>
                    <td><?php echo $oferta->ubicacion; ?></td>
                    <td><?php echo $oferta->salario; ?></td>
                    <td>
                        <?php if ($oferta->oferta_empleocol): ?>
                            <img src="<?php echo $oferta->oferta_empleocol; ?>" alt="Imagen de la oferta" style="width: 100px; height: auto;">
                        <?php else: ?>
                            No hay imagen
                        <?php endif; ?>
                    </td>
                    <td><?php echo $oferta->telefono; ?></td>
                    <td><?php echo $oferta->correo; ?></td>
                    <td><?php echo $oferta->sub_cat_id_sub_cat; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $oferta->id_oferta_empleo; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal<?php echo $oferta->id_oferta_empleo; ?>">Eliminar</button>

                        <!-- Modal para confirmar eliminación -->
                        <div class="modal fade" id="confirmModal<?php echo $oferta->id_oferta_empleo; ?>" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar esta oferta de empleo?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form method="POST" action="eliminar_oferta.php">
                                            <input type="hidden" name="id_oferta_empleo" value="<?php echo $oferta->id_oferta_empleo; ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td> <!-- Celda Opción con el botón Ver más -->
                        <a href="detalle_oferta.php?id=<?php echo $oferta->id_oferta_empleo; ?>" class="btn btn-info btn-sm">Ver más</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="container-fluid d-flex flex-column align-items-center" style="height: 10vh;">
            <a href="../publicar.php" class="btn btn-primary mt-auto text-white text-decoration-none">
                Agregar otro empleo
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
