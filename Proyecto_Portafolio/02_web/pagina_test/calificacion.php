<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['calificacion']) && !empty($_POST['comentario']) && !empty($_POST['fecha']) && !empty($_POST['oferta_empleo_id_oferta_empleo']) && !empty($_POST['usuario_id_usuario'])) {
            $calificacion = $_POST['calificacion'];
            $comentario = $_POST['comentario'];
            $fecha = $_POST['fecha'];
            $oferta_empleo_id_oferta_empleo = $_POST['oferta_empleo_id_oferta_empleo'];
            $usuario_id_usuario = $_POST['usuario_id_usuario'];

            $sql = "INSERT INTO calificaciones (calificacion, comentario, fecha, oferta_empleo_id_oferta_empleo, usuario_id_usuario) VALUES (:calificacion, :comentario, :fecha, :oferta_empleo_id_oferta_empleo, :usuario_id_usuario)";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':calificacion' => $calificacion,
                ':comentario' => $comentario,
                ':fecha' => $fecha,
                ':oferta_empleo_id_oferta_empleo' => $oferta_empleo_id_oferta_empleo,
                ':usuario_id_usuario' => $usuario_id_usuario,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    try {
        // Inicializar la variable de búsqueda
        $buscar = '';
    
        // Comprobar si se ha enviado una búsqueda
        if (isset($_POST['buscar']) && !empty($_POST['buscar'])) {
            $buscar = $_POST['buscar'];
    
            // Consulta SQL con filtro de búsqueda
            $sql = "SELECT * FROM calificaciones WHERE comentario LIKE :buscar OR fecha LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
                // Leer calificaciones
                $sql = "SELECT * FROM calificaciones";
                $stmt = $base_de_datos->query($sql);
        }
    
            // Leer ofertas para el <select>
            $sqlOfertas = "SELECT id_oferta_empleo, titulo_emp FROM oferta_empleo";
            $stmtOfertas = $base_de_datos->query($sqlOfertas);

            // Leer usuarios para el <select>
            $sqlUsuarios = "SELECT id_usuario, usuario FROM usuario";
            $stmtUsuarios = $base_de_datos->query($sqlUsuarios);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }



    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['calificacion']) && !empty($_POST['comentario']) && !empty($_POST['fecha']) && !empty($_POST['oferta_empleo_id_oferta_empleo']) && !empty($_POST['usuario_id_usuario']) && !empty($_POST['idcalificaciones'])) {
            $idcalificaciones = $_POST['idcalificaciones'];
            $calificacion = $_POST['calificacion'];
            $comentario = $_POST['comentario'];
            $fecha = $_POST['fecha'];
            $oferta_empleo_id_oferta_empleo = $_POST['oferta_empleo_id_oferta_empleo'];
            $usuario_id_usuario = $_POST['usuario_id_usuario'];

            $sql = "UPDATE calificaciones SET calificacion = :calificacion, comentario = :comentario, fecha = :fecha, oferta_empleo_id_oferta_empleo = :oferta_empleo_id_oferta_empleo, usuario_id_usuario = :usuario_id_usuario WHERE idcalificaciones = :idcalificaciones";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':calificacion' => $calificacion,
                ':comentario' => $comentario,
                ':fecha' => $fecha,
                ':oferta_empleo_id_oferta_empleo' => $oferta_empleo_id_oferta_empleo,
                ':usuario_id_usuario' => $usuario_id_usuario,
                ':idcalificaciones' => $idcalificaciones,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $idcalificaciones = $_GET['eliminar'];

        $sql = "DELETE FROM calificaciones WHERE idcalificaciones = :idcalificaciones";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':idcalificaciones' => $idcalificaciones]);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".//calificaciones/calificaciones.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Calificaciones</title>
</head>
<body>
<header class="inicio-header">
        <div class="container2">
            <img src="imagenes/logoTotal.png" alt="Logo" class="logo">
            <nav class="nav-center">
                <a href="inicio.html"><button class="btn-lila">Inicio</button></a>
            </nav>
            <div class="user-icon-container">
                <button class="user-icon-btn" onclick="toggleSidebar()">
                <i class="fa fa-bars user-icon"></i>
            </button>
            </div>
        </div>
    </header>

    <aside id="sidebar" class="sidebar">

        <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
        <a href="inicio.html">Inicio</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="empresas.php">Empresas</a>
        <a href="ofertasDeEmpleo.php">Ofertas de Empleo</a>
        <a href="categorias.php">Categorias</a>
        <a href="subcategorias.php">Sub Categorias</a>
        <a href="rol.php">Rol</a>
        <a href="estudios.php">Estudios</a>
        <a href="hoja_de_vida.php">Hoja de vida</a>
        <a href="notificaciones.php">Notificaciones</a>
        <a href="calificacion.php">Calificaciones</a>

    </aside>

    <div class="container mt-5">
    <h3 class="text-center mb-8">Buscar Calificaciones</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Calificaciones" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar Calificaciones">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Calificación</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Calificación</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Oferta de Empleo</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                    // Obtener el nombre de la categoría correspondiente
                    $sqlOfertasNombre = "SELECT titulo_emp FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo";
                    $stmtOfertasNombre = $base_de_datos->prepare($sqlOfertasNombre);
                    $stmtOfertasNombre->execute([':id_oferta_empleo' => $row['oferta_empleo_id_oferta_empleo']]);
                    $ofertaNombre = $stmtOfertasNombre->fetchColumn();

                    $sqlUsuariosNombre = "SELECT usuario FROM usuario WHERE id_usuario = :id_usuario";
                    $stmtUsuariosNombre = $base_de_datos->prepare($sqlUsuariosNombre);
                    $stmtUsuariosNombre->execute([':id_usuario' => $row['usuario_id_usuario']]);
                    $usuariosNombre = $stmtUsuariosNombre->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['idcalificaciones']); ?></td>
                    <td><?php echo htmlspecialchars($row['calificacion']); ?></td>
                    <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($ofertaNombre); ?></td>
                    <td><?php echo htmlspecialchars($usuariosNombre); ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarSubCat(<?php echo htmlspecialchars($row['idcalificaciones']); ?>, '<?php echo htmlspecialchars($row['calificacion']); ?>', '<?php echo htmlspecialchars($row['comentario']); ?>', '<?php echo htmlspecialchars($row['fecha']); ?>', '<?php echo htmlspecialchars($row['oferta_empleo_id_oferta_empleo']); ?>', <?php echo htmlspecialchars($row['usuario_id_usuario']); ?>)">Editar</button>
                        <a href="?eliminar=<?php echo htmlspecialchars($row['idcalificaciones']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta subcategoría?');">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar o editar subcategoría -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Calificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subCategoryForm" method="POST" action="">
                    <input type="hidden" name="idcalificaciones" id="idcalificaciones">
                    <div class="mb-3">
                        <label for="calificacion" class="form-label">Calificación</label>
                            <select class="form-control" id="calificacion" name="calificacion" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                    </div>
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="oferta_empleo_id_oferta_empleo" class="form-label">Ofertas de Empleo</label>
                        <select class="form-select" id="oferta_empleo_id_oferta_empleo" name="oferta_empleo_id_oferta_empleo" required>
                            <option value="" selected disabled>Seleccione una Oferta de Empleo</option>
                            <?php
                            $stmtOfertas->execute();
                            while ($ofertas = $stmtOfertas->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($ofertas['id_oferta_empleo']) . "\">" . htmlspecialchars($ofertas['titulo_emp']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_id_usuario" class="form-label">Usuarios</label>
                        <select class="form-select" id="usuario_id_usuario" name="usuario_id_usuario" required>
                            <option value="" selected disabled>Seleccione un Usuario</option>
                            <?php
                            $stmtUsuarios->execute();
                            while ($usuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($usuarios['id_usuario']) . "\">" . htmlspecialchars($usuarios['usuario']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="crear" class="btn btn-primary" id="crearBtn">Crear</button>
                    <button type="submit" name="actualizar" class="btn btn-success d-none" id="actualizarBtn">Actualizar</button>
                    <button type="button" class="btn btn-secondary d-none" id="cancelarBtn" data-bs-dismiss="modal" onclick="cancelarEdicion()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src=".//calificaciones/calificaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarSubCat(id, calificacion, comentario, fecha, ofertas_id, usuario_id) {
    document.getElementById('idcalificaciones').value = id;
    document.getElementById('calificacion').value = calificacion;
    document.getElementById('comentario').value = comentario;
    document.getElementById('fecha').value = fecha;
    document.getElementById('oferta_empleo_id_oferta_empleo').value = ofertas_id;
    document.getElementById('usuario_id_usuario').value = usuario_id;
    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}

function cancelarEdicion() {
    document.getElementById('idcalificaciones').value = '';
    document.getElementById('calificacion').value = '';
    document.getElementById('comentario').value = '';
    document.getElementById('fecha').value = '';
    document.getElementById('oferta_empleo_id_oferta_empleo').value = '';
    document.getElementById('usuario_id_usuario').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>
