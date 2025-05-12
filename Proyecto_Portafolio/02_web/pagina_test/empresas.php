<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['nombre_emp']) && !empty($_POST['industria']) && !empty($_POST['ubicacion']) && !empty($_POST['tamano_emp']) && !empty($_POST['descripcion_emp']) && !empty($_POST['contacto']) && !empty($_POST['correo']) && !empty($_POST['sitio_web_of']) && !empty($_POST['antecedentes']) && !empty($_POST['mision']) && !empty($_POST['vision']) && !empty($_POST['regionales']) && !empty($_POST['hitos_significativos']) && !empty($_POST['innovaciones_recientes']) && !empty($_POST['beneficios_empleados']) && !empty($_POST['usuario_id_usuario'])) {
            $nombre_emp = $_POST['nombre_emp'];
            $industria = $_POST['industria'];
            $ubicacion = $_POST['ubicacion'];
            $tamano_emp = $_POST['tamano_emp'];
            $descripcion_emp = $_POST['descripcion_emp'];
            $contacto = $_POST['contacto'];
            $correo = $_POST['correo'];
            $sitio_web_of = $_POST['sitio_web_of'];
            $antecedentes = $_POST['antecedentes'];
            $mision = $_POST['mision'];
            $vision = $_POST['vision'];
            $regionales = $_POST['regionales'];
            $hitos_significativos = $_POST['hitos_significativos'];
            $innovaciones_recientes = $_POST['innovaciones_recientes'];
            $beneficios_empleados = $_POST['beneficios_empleados'];
            $usuario_id_usuario = $_POST['usuario_id_usuario'];

            $sql = "INSERT INTO empresas (nombre_emp, industria, ubicacion, tamano_emp, descripcion_emp, contacto, correo, sitio_web_of, antecedentes, mision, vision, regionales, hitos_significativos, innovaciones_recientes, beneficios_empleados, usuario_id_usuario) VALUES (:nombre_emp, :industria, :ubicacion, :tamano_emp, :descripcion_emp, :contacto, :correo, :sitio_web_of, :antecedentes, :mision, :vision, :regionales, :hitos_significativos, :innovaciones_recientes, :beneficios_empleados, :usuario_id_usuario)";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':nombre_emp' => $nombre_emp,
                ':industria' => $industria,
                ':ubicacion' => $ubicacion,
                ':tamano_emp' => $tamano_emp,
                ':descripcion_emp' => $descripcion_emp,
                ':contacto' => $contacto,
                ':correo' => $correo,
                ':sitio_web_of' => $sitio_web_of,
                ':antecedentes' => $antecedentes,
                ':mision' => $mision,
                ':vision' => $vision,
                ':regionales' => $regionales,
                ':hitos_significativos' => $hitos_significativos,
                ':innovaciones_recientes' => $innovaciones_recientes,
                ':beneficios_empleados' => $beneficios_empleados,
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
            $sql = "SELECT * FROM empresas WHERE nombre_emp LIKE :buscar OR industria LIKE :buscar OR ubicacion LIKE :buscar OR tamano_emp LIKE :buscar OR contacto LIKE :buscar OR correo LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
            // Leer subcategorías
            $sql = "SELECT * FROM empresas";
            $stmt = $base_de_datos->query($sql);
        }
    
            // Leer categorías para el <select>
            $sqlUsuarios = "SELECT id_usuario, usuario FROM usuario";
            $stmtUsuarios = $base_de_datos->query($sqlUsuarios);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['nombre_emp']) && !empty($_POST['industria']) && !empty($_POST['ubicacion']) && !empty($_POST['tamano_emp']) && !empty($_POST['descripcion_emp']) && !empty($_POST['contacto']) && !empty($_POST['correo']) && !empty($_POST['sitio_web_of']) && !empty($_POST['antecedentes']) && !empty($_POST['mision']) && !empty($_POST['vision']) && !empty($_POST['regionales']) && !empty($_POST['hitos_significativos']) && !empty($_POST['innovaciones_recientes']) && !empty($_POST['beneficios_empleados']) && !empty($_POST['usuario_id_usuario']) && !empty($_POST['id_empresa'])) {
            $id_empresa = $_POST['id_empresa'];
            $nombre_emp = $_POST['nombre_emp'];
            $industria = $_POST['industria'];
            $ubicacion = $_POST['ubicacion'];
            $tamano_emp = $_POST['tamano_emp'];
            $descripcion_emp = $_POST['descripcion_emp'];
            $contacto = $_POST['contacto'];
            $correo = $_POST['correo'];
            $sitio_web_of = $_POST['sitio_web_of'];
            $antecedentes = $_POST['antecedentes'];
            $mision = $_POST['mision'];
            $vision = $_POST['vision'];
            $regionales = $_POST['regionales'];
            $hitos_significativos = $_POST['hitos_significativos'];
            $innovaciones_recientes = $_POST['innovaciones_recientes'];
            $beneficios_empleados = $_POST['beneficios_empleados'];
            $usuario_id_usuario = $_POST['usuario_id_usuario'];

            $sql = "UPDATE empresas SET nombre_emp = :nombre_emp, industria = :industria, ubicacion = :ubicacion, tamano_emp = :tamano_emp, descripcion_emp = :descripcion_emp, contacto = :contacto, correo = :correo, sitio_web_of = :sitio_web_of, antecedentes = :antecedentes, mision = :mision, vision = :vision, regionales = :regionales, hitos_significativos = :hitos_significativos, innovaciones_recientes = :innovaciones_recientes, beneficios_empleados = :beneficios_empleados, usuario_id_usuario = :usuario_id_usuario WHERE id_empresa = :id_empresa";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':nombre_emp' => $nombre_emp,
                ':industria' => $industria,
                ':ubicacion' => $ubicacion,
                ':tamano_emp' => $tamano_emp,
                ':descripcion_emp' => $descripcion_emp,
                ':contacto' => $contacto,
                ':correo' => $correo,
                ':sitio_web_of' => $sitio_web_of,
                ':antecedentes' => $antecedentes,
                ':mision' => $mision,
                ':vision' => $vision,
                ':regionales' => $regionales,
                ':hitos_significativos' => $hitos_significativos,
                ':innovaciones_recientes' => $innovaciones_recientes,
                ':beneficios_empleados' => $beneficios_empleados,
                ':usuario_id_usuario' => $usuario_id_usuario,
                ':id_empresa' => $id_empresa,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $id_empresa = $_GET['eliminar'];

        $sql = "DELETE FROM empresas WHERE id_empresa = :id_empresa";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_empresa' => $id_empresa]);
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
    <link rel="stylesheet" href=".//empresas/empresas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Empresas</title>
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
    <h3 class="text-center mb-8">Buscar Empresas</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Empresas" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar Empresas">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Empresas</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Empresa</th>
                    <th>Industria</th>
                    <th>Ubicación</th>
                    <th>Tamaño</th>
                    <th>Descripción</th>
                    <th>Contacto</th>
                    <th>Correo</th>
                    <th>Sitio Web</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                    // Obtener el nombre de la categoría correspondiente
                    $sqlUsuarioNombre = "SELECT usuario FROM usuario WHERE id_usuario = :id_usuario";
                    $stmtUsuarioNombre = $base_de_datos->prepare($sqlUsuarioNombre);
                    $stmtUsuarioNombre->execute([':id_usuario' => $row['usuario_id_usuario']]);
                    $usuarioNombre = $stmtUsuarioNombre->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_empresa']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_emp']); ?></td>
                    <td><?php echo htmlspecialchars($row['industria']); ?></td>
                    <td><?php echo htmlspecialchars($row['ubicacion']); ?></td>
                    <td><?php echo htmlspecialchars($row['tamano_emp']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion_emp']); ?></td>
                    <td><?php echo htmlspecialchars($row['contacto']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['sitio_web_of']); ?></td>
                    <td><?php echo htmlspecialchars($usuarioNombre); ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarEmpresa(<?php echo htmlspecialchars($row['id_empresa']); ?>, '<?php echo htmlspecialchars($row['nombre_emp']); ?>', '<?php echo htmlspecialchars($row['industria']); ?>', '<?php echo htmlspecialchars($row['ubicacion']); ?>', '<?php echo htmlspecialchars($row['tamano_emp']); ?>', '<?php echo htmlspecialchars($row['descripcion_emp']); ?>', '<?php echo htmlspecialchars($row['contacto']); ?>', '<?php echo htmlspecialchars($row['correo']); ?>', '<?php echo htmlspecialchars($row['sitio_web_of']); ?>', '<?php echo htmlspecialchars($row['antecedentes']); ?>', '<?php echo htmlspecialchars($row['mision']); ?>', '<?php echo htmlspecialchars($row['vision']); ?>', '<?php echo htmlspecialchars($row['regionales']); ?>', '<?php echo htmlspecialchars($row['hitos_significativos']); ?>', '<?php echo htmlspecialchars($row['innovaciones_recientes']); ?>', '<?php echo htmlspecialchars($row['beneficios_empleados']); ?>', <?php echo htmlspecialchars($row['usuario_id_usuario']); ?>)">Editar</button>
                        <a href="?eliminar=<?php echo htmlspecialchars($row['id_empresa']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta empresa?');">Eliminar</a>
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
                <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Empresas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subCategoryForm" method="POST" action="">
                    <input type="hidden" name="id_empresa" id="id_empresa">
                    <div class="mb-3">
                        <label for="nombre_emp" class="form-label">Nombre Empresa</label>
                        <input type="text" class="form-control" id="nombre_emp" name="nombre_emp" required>
                    </div>

                    <div class="mb-3">
                        <label for="industria" class="form-label">Industria</label>
                        <input type="text" class="form-control" id="industria" name="industria" required>
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                    </div>

                    <div class="mb-3">
                        <label for="tamano_emp" class="form-label">Tamaño</label>
                        <input type="text" class="form-control" id="tamano_emp" name="tamano_emp" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion_emp" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion_emp" name="descripcion_emp" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="sitio_web_of" class="form-label">Sitio Web</label>
                        <input type="text" class="form-control" id="sitio_web_of" name="sitio_web_of" required>
                    </div>

                    <div class="mb-3">
                        <label for="antecedentes" class="form-label">Antecedentes</label>
                        <textarea class="form-control" id="antecedentes" name="antecedentes" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="mision" class="form-label">Misión</label>
                        <textarea class="form-control" id="mision" name="mision" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="vision" class="form-label">Visión</label>
                        <textarea class="form-control" id="vision" name="vision" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="regionales" class="form-label">Regionales</label>
                        <input type="text" class="form-control" id="regionales" name="regionales" required>
                    </div>

                    <div class="mb-3">
                        <label for="hitos-significativos" class="form-label">Hitos Significativos</label>
                        <textarea class="form-control" id="hitos_significativos" name="hitos_significativos" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="innovaciones_recientes" class="form-label">Innovaciones Recientes</label>
                        <textarea class="form-control" id="innovaciones_recientes" name="innovaciones_recientes" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="beneficios_empleados" class="form-label">Beneficios Empleados</label>
                        <textarea class="form-control" id="beneficios_empleados" name="beneficios_empleados" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_id_usuario" class="form-label">Usuario</label>
                        <select class="form-select" id="usuario_id_usuario" name="usuario_id_usuario" required>
                            <option value="" selected disabled>Seleccione un Usuario</option>
                            <?php
                            $stmtUsuarios->execute();
                            while ($usuario = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($usuario['id_usuario']) . "\">" . htmlspecialchars($usuario['usuario']) . "</option>";
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
    <script src=".//empresas/empresas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarEmpresa(id, nombre, industria, ubicacion, tamano_emp, descripcion_emp, contacto, correo, sitio_web_of, antecedentes, mision, vision, regionales, hitos_significativos, innovaciones_recientes, beneficios_empleados, usuario_id) {
    document.getElementById('id_empresa').value = id;
    document.getElementById('nombre_emp').value = nombre;
    document.getElementById('industria').value = industria;
    document.getElementById('ubicacion').value = ubicacion;
    document.getElementById('tamano_emp').value = tamano_emp;
    document.getElementById('descripcion_emp').value = descripcion_emp;
    document.getElementById('contacto').value = contacto;
    document.getElementById('correo').value = correo;
    document.getElementById('sitio_web_of').value = sitio_web_of;
    document.getElementById('antecedentes').value = antecedentes;
    document.getElementById('mision').value = mision;
    document.getElementById('vision').value = vision;
    document.getElementById('regionales').value = regionales;
    document.getElementById('hitos_significativos').value = hitos_significativos;
    document.getElementById('innovaciones_recientes').value = innovaciones_recientes;
    document.getElementById('beneficios_empleados').value = beneficios_empleados;
    document.getElementById('usuario_id_usuario').value = usuario_id;
    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}

function cancelarEdicion() {
    document.getElementById('id_empresa').value = '';
    document.getElementById('nombre_emp').value = '';
    document.getElementById('industria').value = '';
    document.getElementById('ubicacion').value = '';
    document.getElementById('tamano_emp').value = '';
    document.getElementById('descripcion_emp').value = '';
    document.getElementById('contacto').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('sitio_web_of').value = '';
    document.getElementById('antecedentes').value = '';
    document.getElementById('mision').value = '';
    document.getElementById('vision').value = '';
    document.getElementById('regionales').value = '';
    document.getElementById('hitos_significativos').value = '';
    document.getElementById('innovaciones_recientes').value = '';
    document.getElementById('beneficios_empleados').value = '';
    document.getElementById('usuario_id_usuario').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>
