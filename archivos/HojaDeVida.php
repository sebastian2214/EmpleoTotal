<?php
// Incluye el archivo de conexión a la base de datos
require 'conexion.php';

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addRecord'])) {
        // Agregar nuevo registro
        $sql = "INSERT INTO hojade_de_vida (nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo, usuario_id_usuario)
                VALUES (:nombre, :apellido, :direccion, :telefono, :correo, :estado_civil, :fecha_nacimiento, :nacionalidad, :descripcion_sobre_ti, :objetivo_profecional, :idiomas, :referencias, :parentezco, :numero_referencia, :intereses_personales, :disponibilidad_trabajo, :usuario_id_usuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['nombre'],
            ':apellido' => $_POST['apellido'],
            ':direccion' => $_POST['direccion'],
            ':telefono' => $_POST['telefono'],
            ':correo' => $_POST['correo'],
            ':estado_civil' => $_POST['estado_civil'],
            ':fecha_nacimiento' => $_POST['fecha_nacimiento'],
            ':nacionalidad' => $_POST['nacionalidad'],
            ':descripcion_sobre_ti' => $_POST['descripcion_sobre_ti'],
            ':objetivo_profecional' => $_POST['objetivo_profecional'],
            ':idiomas' => $_POST['idiomas'],
            ':referencias' => $_POST['referencias'],
            ':parentezco' => $_POST['parentezco'],
            ':numero_referencia' => $_POST['numero_referencia'],
            ':intereses_personales' => $_POST['intereses_personales'],
            ':disponibilidad_trabajo' => $_POST['disponibilidad_trabajo'],
            ':usuario_id_usuario' => $_POST['usuario_id_usuario']
        ]);
    } elseif (isset($_POST['editRecord'])) {
        // Editar registro
        $sql = "UPDATE hojade_de_vida SET 
                    nombre = :nombre, 
                    apellido = :apellido, 
                    direccion = :direccion, 
                    telefono = :telefono, 
                    correo = :correo, 
                    estado_civil = :estado_civil, 
                    fecha_nacimiento = :fecha_nacimiento, 
                    nacionalidad = :nacionalidad, 
                    descripcion_sobre_ti = :descripcion_sobre_ti, 
                    objetivo_profecional = :objetivo_profecional, 
                    idiomas = :idiomas, 
                    referencias = :referencias, 
                    parentezco = :parentezco, 
                    numero_referencia = :numero_referencia, 
                    intereses_personales = :intereses_personales, 
                    disponibilidad_trabajo = :disponibilidad_trabajo, 
                    usuario_id_usuario = :usuario_id_usuario
                WHERE id_hojade_de_vida = :id_hojade_de_vida";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $_POST['nombre'],
            ':apellido' => $_POST['apellido'],
            ':direccion' => $_POST['direccion'],
            ':telefono' => $_POST['telefono'],
            ':correo' => $_POST['correo'],
            ':estado_civil' => $_POST['estado_civil'],
            ':fecha_nacimiento' => $_POST['fecha_nacimiento'],
            ':nacionalidad' => $_POST['nacionalidad'],
            ':descripcion_sobre_ti' => $_POST['descripcion_sobre_ti'],
            ':objetivo_profecional' => $_POST['objetivo_profecional'],
            ':idiomas' => $_POST['idiomas'],
            ':referencias' => $_POST['referencias'],
            ':parentezco' => $_POST['parentezco'],
            ':numero_referencia' => $_POST['numero_referencia'],
            ':intereses_personales' => $_POST['intereses_personales'],
            ':disponibilidad_trabajo' => $_POST['disponibilidad_trabajo'],
            ':usuario_id_usuario' => $_POST['usuario_id_usuario'],
            ':id_hojade_de_vida' => $_POST['id_hojade_de_vida']
        ]);
    } elseif (isset($_POST['deleteRecord'])) {
        // Eliminar registro
        $sql = "DELETE FROM hojade_de_vida WHERE id_hojade_de_vida = :id_hojade_de_vida";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_hojade_de_vida' => $_POST['id_hojade_de_vida']]);
    }
}

// Buscar registros
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT * FROM hojade_de_vida 
        WHERE nombre LIKE :search 
        OR apellido LIKE :search 
        OR direccion LIKE :search 
        OR telefono LIKE :search 
        OR correo LIKE :search 
        OR estado_civil LIKE :search 
        OR fecha_nacimiento LIKE :search 
        OR nacionalidad LIKE :search 
        OR descripcion_sobre_ti LIKE :search 
        OR objetivo_profecional LIKE :search 
        OR idiomas LIKE :search 
        OR referencias LIKE :search 
        OR parentezco LIKE :search 
        OR numero_referencia LIKE :search 
        OR intereses_personales LIKE :search 
        OR disponibilidad_trabajo LIKE :search";
$stmt = $base_de_datos->prepare($sql);
$stmt->execute([':search' => '%' . $search . '%']);
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener usuarios para el select
$sqlUsuarios = "SELECT id_usuario, usuario FROM usuario";
$stmtUsuarios = $base_de_datos->prepare($sqlUsuarios);
$stmtUsuarios->execute();
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Hoja de Vida</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
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
        <a href="rol.php">Rol</a>
        <a href="empresas.php">Empresas</a>
        <a href="ofertasDeEmpleo.php">Ofertas de Empleo</a>
        <a href="categorias.php">Categorias</a>
        <a href="subcat.php">Sub Categorias</a>
        <a href="estudios.php">Estudios/a>
        <a href="notificaciones.php">Notificaciones</a>
        <a href="calificacion.php">Calificaciones</a>
    </aside>
<body>
    <div class="container mt-5">
        <h1>Gestión de Hoja de Vida</h1>

        <!-- Buscador -->
        <form method="POST" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Tabla de registros -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Estado Civil</th>
                    <th>Fecha de Nacimiento</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($registro['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($registro['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($registro['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($registro['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($registro['correo']); ?></td>
                        <td><?php echo htmlspecialchars($registro['estado_civil']); ?></td>
                        <td><?php echo htmlspecialchars($registro['fecha_nacimiento']); ?></td>
                        
                        <td><?php
                            $usuarioId = $registro['usuario_id_usuario'];
                            $usuario = array_filter($usuarios, function($u) use ($usuarioId) {
                                return $u['id_usuario'] == $usuarioId;
                            });
                            echo $usuario ? htmlspecialchars(reset($usuario)['usuario']) : 'No asignado';
                        ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" 
                                data-id="<?php echo $registro['id_hojade_de_vida']; ?>"
                                data-nombre="<?php echo htmlspecialchars($registro['nombre']); ?>"
                                data-apellido="<?php echo htmlspecialchars($registro['apellido']); ?>"
                                data-direccion="<?php echo htmlspecialchars($registro['direccion']); ?>"
                                data-telefono="<?php echo htmlspecialchars($registro['telefono']); ?>"
                                data-correo="<?php echo htmlspecialchars($registro['correo']); ?>"
                                data-estado_civil="<?php echo htmlspecialchars($registro['estado_civil']); ?>"
                                data-fecha_nacimiento="<?php echo htmlspecialchars($registro['fecha_nacimiento']); ?>"
                                data-nacionalidad="<?php echo htmlspecialchars($registro['nacionalidad']); ?>"
                                data-descripcion_sobre_ti="<?php echo htmlspecialchars($registro['descripcion_sobre_ti']); ?>"
                                data-objetivo_profecional="<?php echo htmlspecialchars($registro['objetivo_profecional']); ?>"
                                data-idiomas="<?php echo htmlspecialchars($registro['idiomas']); ?>"
                                data-referencias="<?php echo htmlspecialchars($registro['referencias']); ?>"
                                data-parentezco="<?php echo htmlspecialchars($registro['parentezco']); ?>"
                                data-numero_referencia="<?php echo htmlspecialchars($registro['numero_referencia']); ?>"
                                data-intereses_personales="<?php echo htmlspecialchars($registro['intereses_personales']); ?>"
                                data-disponibilidad_trabajo="<?php echo htmlspecialchars($registro['disponibilidad_trabajo']); ?>"
                                data-usuario_id_usuario="<?php echo htmlspecialchars($registro['usuario_id_usuario']); ?>"
                            >Editar</button>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="id_hojade_de_vida" value="<?php echo $registro['id_hojade_de_vida']; ?>">
                                <button type="submit" name="deleteRecord" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón para agregar nuevo registro -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Agregar Nuevo</button>

        <!-- Modal para agregar -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Agregar Hoja de Vida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <!-- Campos del formulario para agregar -->
                            <!-- Agregar los campos aquí -->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="form-group">
                                <label for="estado_civil">Estado Civil</label>
                                <input type="text" class="form-control" id="estado_civil" name="estado_civil" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion_sobre_ti">Descripción sobre ti</label>
                                <textarea class="form-control" id="descripcion_sobre_ti" name="descripcion_sobre_ti" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="objetivo_profecional">Objetivo Profesional</label>
                                <textarea class="form-control" id="objetivo_profecional" name="objetivo_profecional" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="idiomas">Idiomas</label>
                                <input type="text" class="form-control" id="idiomas" name="idiomas" required>
                            </div>
                            <div class="form-group">
                                <label for="referencias">Referencias</label>
                                <input type="text" class="form-control" id="referencias" name="referencias" required>
                            </div>
                            <div class="form-group">
                                <label for="parentezco">Parentezco</label>
                                <input type="text" class="form-control" id="parentezco" name="parentezco" required>
                            </div>
                            <div class="form-group">
                                <label for="numero_referencia">Número de Referencia</label>
                                <input type="text" class="form-control" id="numero_referencia" name="numero_referencia" required>
                            </div>
                            <div class="form-group">
                                <label for="intereses_personales">Intereses Personales</label>
                                <input type="text" class="form-control" id="intereses_personales" name="intereses_personales" required>
                            </div>
                            <div class="form-group">
                                <label for="disponibilidad_trabajo">Disponibilidad de Trabajo</label>
                                <input type="text" class="form-control" id="disponibilidad_trabajo" name="disponibilidad_trabajo" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario_id_usuario">Usuario</label>
                                <select class="form-control" id="usuario_id_usuario" name="usuario_id_usuario" required>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['usuario']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" name="addRecord" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para editar -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Hoja de Vida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <input type="hidden" id="edit_id_hojade_de_vida" name="id_hojade_de_vida">
                        <div class="modal-body">
                            <!-- Campos del formulario para editar -->
                            <!-- Agregar los campos aquí -->
                            <div class="form-group">
                                <label for="edit_nombre">Nombre</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_apellido">Apellido</label>
                                <input type="text" class="form-control" id="edit_apellido" name="apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_direccion">Dirección</label>
                                <input type="text" class="form-control" id="edit_direccion" name="direccion" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_telefono">Teléfono</label>
                                <input type="text" class="form-control" id="edit_telefono" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_correo">Correo</label>
                                <input type="email" class="form-control" id="edit_correo" name="correo" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_estado_civil">Estado Civil</label>
                                <input type="text" class="form-control" id="edit_estado_civil" name="estado_civil" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="edit_fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_nacionalidad">Nacionalidad</label>
                                <input type="text" class="form-control" id="edit_nacionalidad" name="nacionalidad" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_descripcion_sobre_ti">Descripción sobre ti</label>
                                <textarea class="form-control" id="edit_descripcion_sobre_ti" name="descripcion_sobre_ti" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_objetivo_profecional">Objetivo Profesional</label>
                                <textarea class="form-control" id="edit_objetivo_profecional" name="objetivo_profecional" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_idiomas">Idiomas</label>
                                <input type="text" class="form-control" id="edit_idiomas" name="idiomas" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_referencias">Referencias</label>
                                <input type="text" class="form-control" id="edit_referencias" name="referencias" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_parentezco">Parentezco</label>
                                <input type="text" class="form-control" id="edit_parentezco" name="parentezco" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_numero_referencia">Número de Referencia</label>
                                <input type="text" class="form-control" id="edit_numero_referencia" name="numero_referencia" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_intereses_personales">Intereses Personales</label>
                                <input type="text" class="form-control" id="edit_intereses_personales" name="intereses_personales" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_disponibilidad_trabajo">Disponibilidad de Trabajo</label>
                                <input type="text" class="form-control" id="edit_disponibilidad_trabajo" name="disponibilidad_trabajo" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_usuario_id_usuario">Usuario</label>
                                <select class="form-control" id="edit_usuario_id_usuario" name="usuario_id_usuario" required>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['usuario']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" name="editRecord" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="adm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Script para rellenar el modal de edición
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);
                modal.find('#edit_id_hojade_de_vida').val(button.data('id'));
                modal.find('#edit_nombre').val(button.data('nombre'));
                modal.find('#edit_apellido').val(button.data('apellido'));
                modal.find('#edit_direccion').val(button.data('direccion'));
                modal.find('#edit_telefono').val(button.data('telefono'));
                modal.find('#edit_correo').val(button.data('correo'));
                modal.find('#edit_estado_civil').val(button.data('estado_civil'));
                modal.find('#edit_fecha_nacimiento').val(button.data('fecha_nacimiento'));
                modal.find('#edit_nacionalidad').val(button.data('nacionalidad'));
                modal.find('#edit_descripcion_sobre_ti').val(button.data('descripcion_sobre_ti'));
                modal.find('#edit_objetivo_profecional').val(button.data('objetivo_profecional'));
                modal.find('#edit_idiomas').val(button.data('idiomas'));
                modal.find('#edit_referencias').val(button.data('referencias'));
                modal.find('#edit_parentezco').val(button.data('parentezco'));
                modal.find('#edit_numero_referencia').val(button.data('numero_referencia'));
                modal.find('#edit_intereses_personales').val(button.data('intereses_personales'));
                modal.find('#edit_disponibilidad_trabajo').val(button.data('disponibilidad_trabajo'));
                modal.find('#edit_usuario_id_usuario').val(button.data('usuario_id_usuario'));
            });
        </script>
    </div>
</body>
</html>
