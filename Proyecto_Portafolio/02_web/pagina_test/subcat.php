<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['nombre_sub_cat']) && !empty($_POST['categoria_id_categora'])) {
            $nombre_sub_cat = $_POST['nombre_sub_cat'];
            $categoria_id_categora = $_POST['categoria_id_categora'];

            $sql = "INSERT INTO sub_cat (nombre_sub_cat, categoria_id_categora) VALUES (:nombre_sub_cat, :categoria_id_categora)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre_sub_cat' => $nombre_sub_cat,
                ':categoria_id_categora' => $categoria_id_categora,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Leer subcategorías
    $sql = "SELECT * FROM sub_cat";
    $stmt = $pdo->query($sql);

    // Leer categorías para el <select>
    $sqlCategorias = "SELECT id_categora, nombre_cat FROM categoria";
    $stmtCategorias = $pdo->query($sqlCategorias);

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['nombre_sub_cat']) && !empty($_POST['categoria_id_categora']) && !empty($_POST['id_sub_cat'])) {
            $id_sub_cat = $_POST['id_sub_cat'];
            $nombre_sub_cat = $_POST['nombre_sub_cat'];
            $categoria_id_categora = $_POST['categoria_id_categora'];

            $sql = "UPDATE sub_cat SET nombre_sub_cat = :nombre_sub_cat, categoria_id_categora = :categoria_id_categora WHERE id_sub_cat = :id_sub_cat";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre_sub_cat' => $nombre_sub_cat,
                ':categoria_id_categora' => $categoria_id_categora,
                ':id_sub_cat' => $id_sub_cat,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $id_sub_cat = $_GET['eliminar'];

        $sql = "DELETE FROM sub_cat WHERE id_sub_cat = :id_sub_cat";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_sub_cat' => $id_sub_cat]);
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
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <a href="categoria.php">Categorias</a>
        <a href="subcategorias.php">Sub Categorias</a>
        <a href="mensajes.php">Mensajes</a>
        <a href="notificaciones.php">Notificaciones</a>
        <a href="calificacion.php">Calificaciones</a>
    </aside>

<div class="container mt-5">
    <h2 class="mb-4">CRUD de Subcategorías</h2>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Subcategoría</button>

    <!-- Tabla para mostrar datos -->
    <div class="table-container">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Subcategoría</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                    // Obtener el nombre de la categoría correspondiente
                    $sqlCategoriaNombre = "SELECT nombre_cat FROM categoria WHERE id_categora = :id_categora";
                    $stmtCategoriaNombre = $pdo->prepare($sqlCategoriaNombre);
                    $stmtCategoriaNombre->execute([':id_categora' => $row['categoria_id_categora']]);
                    $categoriaNombre = $stmtCategoriaNombre->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_sub_cat']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_sub_cat']); ?></td>
                    <td><?php echo htmlspecialchars($categoriaNombre); ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarSubCat(<?php echo htmlspecialchars($row['id_sub_cat']); ?>, '<?php echo htmlspecialchars($row['nombre_sub_cat']); ?>', <?php echo htmlspecialchars($row['categoria_id_categora']); ?>)">Editar</button>
                        <a href="?eliminar=<?php echo htmlspecialchars($row['id_sub_cat']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta subcategoría?');">Eliminar</a>
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
                <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Subcategoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subCategoryForm" method="POST" action="">
                    <input type="hidden" name="id_sub_cat" id="id_sub_cat">
                    <div class="mb-3">
                        <label for="nombre_sub_cat" class="form-label">Nombre Subcategoría</label>
                        <input type="text" class="form-control" id="nombre_sub_cat" name="nombre_sub_cat" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria_id_categora" class="form-label">Categoría</label>
                        <select class="form-select" id="categoria_id_categora" name="categoria_id_categora" required>
                            <option value="" selected disabled>Seleccione una categoría</option>
                            <?php
                            $stmtCategorias->execute();
                            while ($categoria = $stmtCategorias->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($categoria['id_categora']) . "\">" . htmlspecialchars($categoria['nombre_cat']) . "</option>";
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
    <script src="adm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarSubCat(id, nombre, categoria_id) {
    document.getElementById('id_sub_cat').value = id;
    document.getElementById('nombre_sub_cat').value = nombre;
    document.getElementById('categoria_id_categora').value = categoria_id;
    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}

function cancelarEdicion() {
    document.getElementById('id_sub_cat').value = '';
    document.getElementById('nombre_sub_cat').value = '';
    document.getElementById('categoria_id_categora').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>
