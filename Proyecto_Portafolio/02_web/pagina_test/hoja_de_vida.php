<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['direccion']) && !empty($_POST['telefono']) && !empty($_POST['correo']) && !empty($_POST['estado_civil']) && !empty($_POST['fecha_nacimiento']) && !empty($_POST['nacionalidad']) && !empty($_POST['descripcion_sobre_ti']) && !empty($_POST['objetivo_profecional']) && !empty($_POST['idiomas']) && !empty($_POST['referencias']) && !empty($_POST['parentezco']) && !empty($_POST['numero_referencia']) && !empty($_POST['intereses_personales']) && !empty($_POST['disponibilidad_trabajo']) && !empty($_POST['usuario_id_usuario'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $estado_civil = $_POST['estado_civil'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $nacionalidad = $_POST['nacionalidad'];
            $descripcion_sobre_ti = $_POST['descripcion_sobre_ti'];
            $objetivo_profecional = $_POST['objetivo_profecional'];
            $idiomas = $_POST['idiomas'];
            $referencias = $_POST['referencias'];
            $parentezco = $_POST['parentezco'];
            $numero_referencia = $_POST['numero_referencia'];
            $intereses_personales = $_POST['intereses_personales'];
            $disponibilidad_trabajo = $_POST['disponibilidad_trabajo'];
            $usuario_id_usuario = $_POST['usuario_id_usuario'];

            $sql = "INSERT INTO hojade_de_vida (nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo, usuario_id_usuario) VALUES (:nombre, :apellido, :direccion, :telefono, :correo, :estado_civil, :fecha_nacimiento, :nacionalidad, :descripcion_sobre_ti, :objetivo_profecional, :idiomas, :referencias, :parentezco, :numero_referencia, :intereses_personales, :disponibilidad_trabajo, :usuario_id_usuario)";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':correo' => $correo,
                ':estado_civil' => $estado_civil,
                ':fecha_nacimiento' => $fecha_nacimiento,
                ':nacionalidad' => $nacionalidad,
                ':descripcion_sobre_ti' => $descripcion_sobre_ti,
                ':objetivo_profecional' => $objetivo_profecional,
                ':idiomas' => $idiomas,
                ':referencias' => $referencias,
                ':parentezco' => $parentezco,
                ':numero_referencia' => $numero_referencia,
                ':intereses_personales' => $intereses_personales,
                ':disponibilidad_trabajo' => $disponibilidad_trabajo,
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
            $sql = "SELECT * FROM hojade_de_vida WHERE nombre LIKE :buscar OR apellido LIKE :buscar OR direccion LIKE :buscar OR telefono LIKE :buscar OR correo LIKE :buscar OR estado_civil LIKE :buscar OR fecha_nacimiento LIKE :buscar OR nacionalidad LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
            // Leer hoja de vida
            $sql = "SELECT * FROM hojade_de_vida";
            $stmt = $base_de_datos->query($sql);
        }
    
            // Leer usuarios para el <select>
            $sqUsuarios = "SELECT id_usuario, usuario FROM usuario";
            $stmtUsuarios = $base_de_datos->query($sqUsuarios);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['direccion']) && !empty($_POST['telefono']) && !empty($_POST['correo']) && !empty($_POST['estado_civil']) && !empty($_POST['fecha_nacimiento']) && !empty($_POST['nacionalidad']) && !empty($_POST['descripcion_sobre_ti']) && !empty($_POST['objetivo_profecional']) && !empty($_POST['idiomas']) && !empty($_POST['referencias']) && !empty($_POST['parentezco']) && !empty($_POST['numero_referencia']) && !empty($_POST['intereses_personales']) && !empty($_POST['disponibilidad_trabajo']) && !empty($_POST['usuario_id_usuario']) && !empty($_POST['id_hojade_de_vida'])) {
            $id_hojade_de_vida = $_POST['id_hojade_de_vida'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $estado_civil = $_POST['estado_civil'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $nacionalidad = $_POST['nacionalidad'];
            $descripcion_sobre_ti = $_POST['descripcion_sobre_ti'];
            $objetivo_profecional = $_POST['objetivo_profecional'];
            $idiomas = $_POST['idiomas'];
            $referencias = $_POST['referencias'];
            $parentezco = $_POST['parentezco'];
            $numero_referencia = $_POST['numero_referencia'];
            $intereses_personales = $_POST['intereses_personales'];
            $disponibilidad_trabajo = $_POST['disponibilidad_trabajo'];
            $usuario_id_usuario = $_POST['usuario_id_usuario'];

            $sql = "UPDATE hojade_de_vida SET nombre = :nombre, apellido = :apellido, direccion = :direccion, telefono = :telefono, correo = :correo, estado_civil = :estado_civil, fecha_nacimiento = :fecha_nacimiento, nacionalidad = :nacionalidad, descripcion_sobre_ti = :descripcion_sobre_ti, objetivo_profecional = :objetivo_profecional, idiomas = :idiomas, referencias = :referencias, parentezco = :parentezco, numero_referencia = :numero_referencia, intereses_personales = :intereses_personales, disponibilidad_trabajo = :disponibilidad_trabajo, usuario_id_usuario = :usuario_id_usuario WHERE id_hojade_de_vida = :id_hojade_de_vida";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':correo' => $correo,
                ':estado_civil' => $estado_civil,
                ':fecha_nacimiento' => $fecha_nacimiento,
                ':nacionalidad' => $nacionalidad,
                ':descripcion_sobre_ti' => $descripcion_sobre_ti,
                ':objetivo_profecional' => $objetivo_profecional,
                ':idiomas' => $idiomas,
                ':referencias' => $referencias,
                ':parentezco' => $parentezco,
                ':numero_referencia' => $numero_referencia,
                ':intereses_personales' => $intereses_personales,
                ':disponibilidad_trabajo' => $disponibilidad_trabajo,
                ':usuario_id_usuario' => $usuario_id_usuario,
                ':id_hojade_de_vida' => $id_hojade_de_vida,
            ]);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $id_hojade_de_vida = $_GET['eliminar'];

        $sql = "DELETE FROM hojade_de_vida WHERE id_hojade_de_vida = :id_hojade_de_vida";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_hojade_de_vida' => $id_hojade_de_vida]);
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
    <link rel="stylesheet" href=".//hojaVida/hojaVida.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Hojas de Vida</title>
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
    <h3 class="text-center mb-8">Buscar Hoja de Vida</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Hoja de Vida" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar hojaVida">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Hojas de Vida</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Estado Civil</th>
                    <th>Fecha Nacimiento</th>
                    <th>Nacionalidad</th>
                    <th>Descripcion de Ti</th>
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
                    <td><?php echo htmlspecialchars($row['id_hojade_de_vida']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['estado_civil']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                    <td><?php echo htmlspecialchars($row['nacionalidad']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion_sobre_ti']); ?></td>
                    <td><?php echo htmlspecialchars($usuarioNombre); ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editarHojadeVida(<?php echo htmlspecialchars($row['id_hojade_de_vida']); ?>, '<?php echo htmlspecialchars($row['nombre']); ?>', '<?php echo htmlspecialchars($row['apellido']); ?>', '<?php echo htmlspecialchars($row['direccion']); ?>', '<?php echo htmlspecialchars($row['telefono']); ?>', '<?php echo htmlspecialchars($row['correo']); ?>', '<?php echo htmlspecialchars($row['estado_civil']); ?>', '<?php echo htmlspecialchars($row['fecha_nacimiento']); ?>', '<?php echo htmlspecialchars($row['nacionalidad']); ?>', '<?php echo htmlspecialchars($row['descripcion_sobre_ti']); ?>', '<?php echo htmlspecialchars($row['objetivo_profecional']); ?>', '<?php echo htmlspecialchars($row['idiomas']); ?>', '<?php echo htmlspecialchars($row['referencias']); ?>', '<?php echo htmlspecialchars($row['parentezco']); ?>', '<?php echo htmlspecialchars($row['numero_referencia']); ?>', '<?php echo htmlspecialchars($row['intereses_personales']); ?>', '<?php echo htmlspecialchars($row['disponibilidad_trabajo']); ?>', <?php echo htmlspecialchars($row['usuario_id_usuario']); ?>)">Editar</button>
                        <a href="?eliminar=<?php echo htmlspecialchars($row['id_hojade_de_vida']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta empresa?');">Eliminar</a>
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
                    <input type="hidden" name="id_hojade_de_vida" id="id_hojade_de_vida">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="estado_civil" class="form-label">Estado Civil</label>
                            <select class="form-control" id="estado_civil" name="estado_civil" required>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Unión libre">Unión libre</option>
                                <option value="Separado">Separado</option>
                                <option value="Comprometido">Comprometido</option>
                            </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>

                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion_sobre_ti" class="form-label">Descripcion de Ti</label>
                        <textarea class="form-control" id="descripcion_sobre_ti" name="descripcion_sobre_ti" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="objetivo_profecional" class="form-label">Objetivo Profesional</label>
                        <textarea class="form-control" id="objetivo_profecional" name="objetivo_profecional" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="idiomas" class="form-label">Idiomas</label>
                        <textarea class="form-control" id="idiomas" name="idiomas" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="referencias" class="form-label">Referencias</label>
                        <textarea class="form-control" id="referencias" name="referencias" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="parentezco" class="form-label">Parentezco</label>
                        <textarea class="form-control" id="parentezco" name="parentezco" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="numero_referencia" class="form-label">Numero Referencia</label>
                        <input type="text" class="form-control" id="numero_referencia" name="numero_referencia" required>
                    </div>

                    <div class="mb-3">
                        <label for="intereses_personales" class="form-label">Intereses Personales</label>
                        <textarea class="form-control" id="intereses_personales" name="intereses_personales" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="disponibilidad_trabajo" class="form-label">Disponibilidad de Trabajo</label>
                        <textarea class="form-control" id="disponibilidad_trabajo" name="disponibilidad_trabajo" required></textarea>
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
    <script src=".//hojaVida/hojaVida.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarHojadeVida(id, nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo, usuario_id) {
    document.getElementById('id_hojade_de_vida').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('apellido').value = apellido;
    document.getElementById('direccion').value = direccion;
    document.getElementById('telefono').value = telefono;
    document.getElementById('correo').value = correo;
    document.getElementById('estado_civil').value = estado_civil;
    document.getElementById('fecha_nacimiento').value = fecha_nacimiento;
    document.getElementById('nacionalidad').value = nacionalidad;
    document.getElementById('descripcion_sobre_ti').value = descripcion_sobre_ti;
    document.getElementById('objetivo_profecional').value = objetivo_profecional;
    document.getElementById('idiomas').value = idiomas;
    document.getElementById('referencias').value = referencias;
    document.getElementById('parentezco').value = parentezco;
    document.getElementById('numero_referencia').value = numero_referencia;
    document.getElementById('intereses_personales').value = intereses_personales;
    document.getElementById('disponibilidad_trabajo').value = disponibilidad_trabajo;
    document.getElementById('usuario_id_usuario').value = usuario_id;
    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}

function cancelarEdicion() {
    document.getElementById('id_hojade_de_vida').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('apellido').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('estado_civil').value = '';
    document.getElementById('fecha_nacimiento').value = '';
    document.getElementById('nacionalidad').value = '';
    document.getElementById('descripcion_sobre_ti').value = '';
    document.getElementById('objetivo_profecional').value = '';
    document.getElementById('idiomas').value = '';
    document.getElementById('referencias').value = '';
    document.getElementById('parentezco').value = '';
    document.getElementById('numero_referencia').value = '';
    document.getElementById('intereses_personales').value = '';
    document.getElementById('disponibilidad_trabajo').value = '';
    document.getElementById('usuario_id_usuario').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>
