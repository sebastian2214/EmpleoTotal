<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['intitucion']) && !empty($_POST['titulo']) && !empty($_POST['fecha_inicio']) && !empty($_POST['fecha_fin']) && !empty($_POST['hojade_de_vida_id_hojade_de_vida'])) {
            $intitucion = $_POST['intitucion'];
            $titulo = $_POST['titulo'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $hojade_de_vida_id_hojade_de_vida = $_POST['hojade_de_vida_id_hojade_de_vida'];

            $sql = "INSERT INTO estudios (intitucion, titulo, fecha_inicio, fecha_fin, hojade_de_vida_id_hojade_de_vida) VALUES (:intitucion, :titulo, :fecha_inicio, :fecha_fin,:hojade_de_vida_id_hojade_de_vida)";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':intitucion' => $intitucion,
                ':titulo' => $titulo,
                ':fecha_inicio' => $fecha_inicio,
                ':fecha_fin' => $fecha_fin,
                ':hojade_de_vida_id_hojade_de_vida' => $hojade_de_vida_id_hojade_de_vida,
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
            $sql = "SELECT * FROM estudios WHERE intitucion LIKE :buscar OR titulo LIKE :buscar OR fecha_inicio LIKE :buscar OR fecha_fin LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
            // Leer estudios
            $sql = "SELECT * FROM estudios";
            $stmt = $base_de_datos->query($sql);
        }
    
            // Leer hoja de vida para el <select>
            $sqlhojaVida = "SELECT id_hojade_de_vida, nombre FROM hojade_de_vida";
            $stmthojaVida = $base_de_datos->query($sqlhojaVida);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['intitucion']) && !empty($_POST['titulo']) && !empty($_POST['fecha_inicio']) && !empty($_POST['fecha_fin']) && !empty($_POST['hojade_de_vida_id_hojade_de_vida']) && !empty($_POST['idEstudios'])) {
            $idEstudios = $_POST['idEstudios'];
            $intitucion = $_POST['intitucion'];
            $titulo = $_POST['titulo'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $hojade_de_vida_id_hojade_de_vida = $_POST['hojade_de_vida_id_hojade_de_vida'];

            $sql = "UPDATE estudios SET intitucion = :intitucion, titulo = :titulo, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, hojade_de_vida_id_hojade_de_vida = :hojade_de_vida_id_hojade_de_vida WHERE idEstudios = :idEstudios";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':intitucion' => $intitucion,
                ':titulo' => $titulo,
                ':fecha_inicio' => $fecha_inicio,
                ':fecha_fin' => $fecha_fin,
                ':hojade_de_vida_id_hojade_de_vida' => $hojade_de_vida_id_hojade_de_vida,
                ':idEstudios' => $idEstudios,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $idEstudios = $_GET['eliminar'];

        $sql = "DELETE FROM estudios WHERE idEstudios = :idEstudios";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':idEstudios' => $idEstudios]);
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
    <link rel="stylesheet" href=".//estudios/estudios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Estudios</title>
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
    <h3 class="text-center mb-8">Buscar Estudios</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Estudios" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar Estudios">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Estudios</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Institución</th>
                    <th>Titulo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Hoja de Vida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                    // Obtener el nombre de la categoría correspondiente
                    $sqlhojaVidaNombre = "SELECT nombre FROM hojade_de_vida WHERE id_hojade_de_vida = :id_hojade_de_vida";
                    $stmthojaVidaNombre = $base_de_datos->prepare($sqlhojaVidaNombre);
                    $stmthojaVidaNombre->execute([':id_hojade_de_vida' => $row['hojade_de_vida_id_hojade_de_vida']]);
                    $hojaVidaNombre = $stmthojaVidaNombre->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['idEstudios']); ?></td>
                    <td><?php echo htmlspecialchars($row['intitucion']); ?></td>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_inicio']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_fin']); ?></td>
                    <td><?php echo htmlspecialchars($hojaVidaNombre); ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarSubCat(<?php echo htmlspecialchars($row['idEstudios']); ?>, '<?php echo htmlspecialchars($row['intitucion']); ?>', '<?php echo htmlspecialchars($row['titulo']); ?>', '<?php echo htmlspecialchars($row['fecha_inicio']); ?>', '<?php echo htmlspecialchars($row['fecha_fin']); ?>', <?php echo htmlspecialchars($row['hojade_de_vida_id_hojade_de_vida']); ?>)">Editar</button>
                        <a href="?eliminar=<?php echo htmlspecialchars($row['idEstudios']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta subcategoría?');">Eliminar</a>
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
                <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Hoja de Vida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subCategoryForm" method="POST" action="">
                    <input type="hidden" name="idEstudios" id="idEstudios">
                    <div class="mb-3">
                        <label for="intitucion" class="form-label">Institución</label>
                        <input type="text" class="form-control" id="intitucion" name="intitucion" required>
                    </div>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="hojade_de_vida_id_hojade_de_vida" class="form-label">Hoja de Vida</label>
                        <select class="form-select" id="hojade_de_vida_id_hojade_de_vida" name="hojade_de_vida_id_hojade_de_vida" required>
                            <option value="" selected disabled>Seleccione una Hoja de Vida</option>
                            <?php
                            $stmthojaVida->execute();
                            while ($hojaVida = $stmthojaVida->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($hojaVida['id_hojade_de_vida']) . "\">" . htmlspecialchars($hojaVida['nombre']) . "</option>";
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
    <script src=".//estudios/estudios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarSubCat(id, institucion, titulo, fecha_inicio, fecha_fin, hojaVida_id) {
    document.getElementById('idEstudios').value = id;
    document.getElementById('intitucion').value = institucion;
    document.getElementById('titulo').value = titulo;
    document.getElementById('fecha_inicio').value = fecha_inicio;
    document.getElementById('fecha_fin').value = fecha_fin;
    document.getElementById('hojade_de_vida_id_hojade_de_vida').value = hojaVida_id;
    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}

function cancelarEdicion() {
    document.getElementById('idEstudios').value = '';
    document.getElementById('intitucion').value = '';
    document.getElementById('titulo').value = '';
    document.getElementById('fecha_inicio').value = '';
    document.getElementById('fecha_fin').value = '';
    document.getElementById('hojade_de_vida_id_hojade_de_vida').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>
