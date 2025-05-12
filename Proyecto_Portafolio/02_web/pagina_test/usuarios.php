<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['usuario']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['rol_id_rol'])) {
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            $rol_id_rol = $_POST['rol_id_rol'];

            $sql = "INSERT INTO usuario (usuario, correo, contrasena, rol_id_rol) VALUES (:usuario, :correo, :contrasena, :rol_id_rol)";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':usuario' => $usuario,
                ':correo' => $correo,
                ':contrasena' => $contrasena,
                ':rol_id_rol' => $rol_id_rol,
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
            $sql = "SELECT * FROM usuario WHERE usuario LIKE :buscar OR correo LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
                // Leer usuarios
                $sql = "SELECT * FROM usuario";
                $stmt = $base_de_datos->query($sql);
        }
    
                // Leer roles para el <select>
                $sqlRoles = "SELECT id_rol, nombre_rol FROM rol";
                $stmtRoles = $base_de_datos->query($sqlRoles);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['usuario']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['rol_id_rol']) && !empty($_POST['id_usuario'])) {
            $id_usuario = $_POST['id_usuario'];
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $rol_id_rol = $_POST['rol_id_rol'];

            $sql = "UPDATE usuario SET usuario = :usuario, correo = :correo, contrasena = :contrasena, rol_id_rol = :rol_id_rol WHERE id_usuario = :id_usuario";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':usuario' => $usuario,
                ':correo' => $correo,
                ':contrasena' => $contrasena,
                ':rol_id_rol' => $rol_id_rol,
                ':id_usuario' => $id_usuario,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $id_usuario = $_GET['eliminar'];

        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
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
    <link rel="stylesheet" href=".//usuarios/usuarios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Usuarios</title>
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
    <h3 class="text-center mb-8">Buscar Usuarios</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Usuarios" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar Usuarios">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Usuario</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuarios</th>
                    <th>Correo</th>
                    <th>Contrasena</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                    // Obtener el nombre de la categoría correspondiente
                    $sqlRolNombre = "SELECT nombre_rol FROM rol WHERE id_rol = :id_rol";
                    $stmtRolNombre = $base_de_datos->prepare($sqlRolNombre);
                    $stmtRolNombre->execute([':id_rol' => $row['rol_id_rol']]);
                    $rolNombre = $stmtRolNombre->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['contrasena']); ?></td>
                    <td><?php echo htmlspecialchars($rolNombre); ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarUsuario(<?php echo htmlspecialchars($row['id_usuario']); ?>, '<?php echo htmlspecialchars($row['usuario']); ?>', '<?php echo htmlspecialchars($row['correo']); ?>', '<?php echo htmlspecialchars($row['contrasena']); ?>', <?php echo htmlspecialchars($row['rol_id_rol']); ?>)">Editar</button>
                        <a href="?eliminar=<?php echo htmlspecialchars($row['id_usuario']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta usuario?');">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar o editar usuario -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subCategoryForm" method="POST" action="">
                    <input type="hidden" name="id_usuario" id="id_usuario">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Corrreo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="mb-3">
                        <label for="rol_id_rol" class="form-label">Roles</label>
                        <select class="form-select" id="rol_id_rol" name="rol_id_rol" required>
                            <option value="" selected disabled>Seleccione un Rol</option>
                            <?php
                            $stmtRoles->execute();
                            while ($rol = $stmtRoles->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($rol['id_rol']) . "\">" . htmlspecialchars($rol['nombre_rol']) . "</option>";
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
    <script src=".//usuarios/usuarios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarUsuario(id, nombre, correo, contrasena, rol_id) {
    document.getElementById('id_usuario').value = id;
    document.getElementById('usuario').value = nombre;
    document.getElementById('correo').value = correo;
    document.getElementById('contrasena').value = contrasena;
    document.getElementById('rol_id_rol').value = rol_id;
    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}

function cancelarEdicion() {
    document.getElementById('id_usuario').value = '';
    document.getElementById('usuario').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('contrasena').value = '';
    document.getElementById('rol_id_rol').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>
