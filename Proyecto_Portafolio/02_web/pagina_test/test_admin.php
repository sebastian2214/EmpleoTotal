<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['resultado']) && !empty($_FILES['imagen_test']['tmp_name']) && !empty($_POST['usuario_id']) && !empty($_POST['oferta_id'])) {
            $resultado = $_POST['resultado'];
            $usuario_id = $_POST['usuario_id'];
            $oferta_id = $_POST['oferta_id'];
    
            // Procesar la imagen
            $nombreImagen = $_FILES['imagen_test']['name'];
            $rutaTemporal = $_FILES['imagen_test']['tmp_name'];
            $rutaDestino = 'uploads/' . uniqid() . '_' . $nombreImagen;  // Ruta única
    
            // Mover la imagen a la carpeta del servidor
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                // Insertar en la base de datos
                $sql = "INSERT INTO test_oferta (resultado, imagen_test, usuario_id, oferta_id) 
                        VALUES (:resultado, :imagen_test, :usuario_id, :oferta_id)";
                $stmt = $base_de_datos->prepare($sql);
                $stmt->execute([
                    ':resultado' => $resultado,
                    ':imagen_test' => $rutaDestino,  // Guardar la ruta de la imagen
                    ':usuario_id' => $usuario_id,
                    ':oferta_id' => $oferta_id,
                ]);
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $error_message = "Error al subir la imagen.";
            }
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
            $sql = "SELECT * FROM test_oferta WHERE resultado LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
            // Consulta SQL sin filtro de búsqueda
            $sql = "SELECT * FROM test_oferta";
            $stmt = $base_de_datos->query($sql);
        }

        $sqlUsuarios = "SELECT id_usuario, usuario FROM usuario";
        $stmtUsuarios = $base_de_datos->query($sqlUsuarios);

        // Leer categorías para el <select>
        $sqlOfertas = "SELECT id_oferta_empleo, titulo_emp FROM oferta_empleo";
        $stmtOfertas = $base_de_datos->query($sqlOfertas);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['resultado']) && !empty($_POST['usuario_id']) && !empty($_POST['oferta_id'])) {
            $id_test = $_POST['id_test'];
            $resultado = $_POST['resultado'];
            $usuario_id = $_POST['usuario_id'];
            $oferta_id = $_POST['oferta_id'];;
    
            // Obtener la ruta de la imagen actual
            $sql = "SELECT imagen_test FROM test_oferta WHERE id_test = :id_test";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':id_test' => $id_test]);
            $rutaImagenActual = $stmt->fetchColumn();
    
            // Si se sube una nueva imagen
            if (!empty($_FILES['imagen_test']['tmp_name'])) {
                $nombreImagen = $_FILES['imagen_test']['name'];
                $rutaTemporal = $_FILES['imagen_test']['tmp_name'];
                $rutaDestino = 'uploads/' . uniqid() . '_' . $nombreImagen;
    
                // Mover la nueva imagen al servidor
                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    // Eliminar la imagen anterior del servidor, si existe
                    if ($rutaImagenActual && file_exists($rutaImagenActual)) {
                        unlink($rutaImagenActual);
                    }
    
                    // Actualizar todos los campos, incluyendo la nueva imagen  
                    $sql = "UPDATE test_oferta 
                            SET resultado = :resultado, 
                                imagen_test = :imagen_test, 
                                usuario_id = :usuario_id, 
                                oferta_id = :oferta_id, 
                            WHERE id_test = :id_test";
                    $stmt = $base_de_datos->prepare($sql);
                    $stmt->execute([
                        ':resultado' => $resultado,
                        ':imagen_test' => $rutaDestino,  // Guardar la nueva ruta de la imagen
                        ':usuario_id' => $usuario_id,
                        ':oferta_id' => $oferta_id,
                        ':id_test' => $id_test,
                    ]);
                } else {
                    $error_message = "Error al subir la nueva imagen.";
                }
            } else {
                // Si no hay imagen nueva, mantener la imagen anterior y actualizar los demás campos
                $sql = "UPDATE test_oferta 
                        SET resultado = :resultado, 
                            usuario_id = :usuario_id, 
                            oferta_id = :oferta_id, 
                        WHERE id_test = :id_test";
                $stmt = $base_de_datos->prepare($sql);
                $stmt->execute([
                    ':resultado' => $resultado,
                    ':usuario_id' => $usuario_id,
                    ':oferta_id' => $oferta_id,
                    ':id_test' => $id_test,
                ]);
            }
    
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Todos los campos son obligatorios.";
        }
    }
    
    

    // Eliminar
    if (isset($_GET['eliminar'])) {
        $id_test = $_GET['eliminar'];
    
        // Obtener la ruta de la imagen antes de eliminar
        $sql = "SELECT imagen_test FROM test_oferta WHERE id_test = :id_test";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_test' => $id_test]);
        $rutaImagen = $stmt->fetchColumn();
    
        // Eliminar la oferta de la base de datos
        $sql = "DELETE FROM test_oferta WHERE id_test = :id_test";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_test' => $id_test]);
    
        // Eliminar la imagen del servidor
        if ($rutaImagen && file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    
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
    <link rel="stylesheet" href=".//ofertas/ofertas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Test</title>

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
        <a href="test_admin.php">Test Ofertas de Empleo</a>
        <a href="categorias.php">Categorias</a>
        <a href="subcategorias.php">Sub Categorias</a>
        <a href="rol.php">Rol</a>
        <a href="estudios.php">Estudios</a>
        <a href="hoja_de_vida.php">Hoja de vida</a>
        <a href="notificaciones_admin.php">Notificaciones</a>
        <a href="calificacion.php">Calificaciones</a>
        <a href="http://localhost:3000">Cerrar Sesión</a>

    </aside>

    <div class="container mt-5">
    <h3 class="text-center mb-8">Buscar Test</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Test" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar test">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>


    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Test</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Resultado</th>
            <th>Imagen Resultado</th>
            <th>Usuario</th>
            <th>Oferta de Empleo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

            $sqlUsuarioNombre = "SELECT usuario FROM usuario WHERE id_usuario = :id_usuario";
            $stmtUsuarioNombre = $base_de_datos->prepare($sqlUsuarioNombre);
            $stmtUsuarioNombre->execute([':id_usuario' => $row['usuario_id']]);
            $usuarioNombre = $stmtUsuarioNombre->fetchColumn();

            // Obtener el nombre de la subcategoría correspondiente
            $sqlOfertasNombre = "SELECT titulo_emp FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo";
            $stmtOfertasNombre = $base_de_datos->prepare($sqlOfertasNombre);
            $stmtOfertasNombre->execute([':id_oferta_empleo' => $row['oferta_id']]);
            $ofertasNombre = $stmtOfertasNombre->fetchColumn();
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['resultado']); ?></td>
            <td>
                <!-- Mostrar la imagen de la oferta si existe -->
                <?php if (!empty($row['imagen_test'])): ?>
                    <img src="<?php echo htmlspecialchars($row['imagen_test']); ?>" alt="Imagen de la oferta" width="100">
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($usuarioNombre); ?></td>
            <td><?php echo htmlspecialchars($ofertasNombre); ?></td>
            <td>
                <button class="btn btn-warning" onclick="editarOferta(<?php echo htmlspecialchars($row['id_test']); ?>, '<?php echo htmlspecialchars($row['resultado']); ?>', '<?php echo htmlspecialchars($row['imagen_test']); ?>', '<?php echo htmlspecialchars($row['usuario_id']); ?>', '<?php echo htmlspecialchars($row['oferta_id']); ?>')">Editar</button>
                <a href="?eliminar=<?php echo htmlspecialchars($row['id_test']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta empresa?');">Eliminar</a>
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
                <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="subCategoryForm" method="POST" action="" enctype="multipart/form-data" >
                    <input type="hidden" name="id_test" id="id_test">
                    <div class="mb-3">
                        <label for="resultado" class="form-label">Resultado</label>
                        <input type="text" class="form-control" id="resultado" name="resultado" required>
                    </div>

                    <div id="imagenActual" class="mb-3"></div>

                    <div class="mb-3">
                        <label for="imagen_test" class="form-label">Imagen Oferta</label>
                        <input type="file" class="form-control" id="imagen_test" name="imagen_test">
                    </div>

                    <div class="mb-3">
                        <label for="usuario_id" class="form-label">Usuario</label>
                        <select class="form-select" id="usuario_id" name="usuario_id" required>
                            <option value="" selected disabled>Seleccione un Usuario</option>
                            <?php
                            $stmtUsuarios->execute();
                            while ($usuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($usuarios['id_usuario']) . "\">" . htmlspecialchars($usuarios['usuario']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_oferta_empleo" class="form-label">Oferta de Empleo</label>
                        <select class="form-select" id="id_oferta_empleo" name="id_oferta_empleo" required>
                            <option value="" selected disabled>Seleccione una Oferta de Empleo</option>
                            <?php
                            $stmtOfertas->execute();
                            while ($ofertas = $stmtOfertas->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($ofertas['id_oferta_empleo']) . "\">" . htmlspecialchars($ofertas['titulo_emp']) . "</option>";
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
    <script src="./ofertas/ofertas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarOferta(id, resultado, imagen_test, usuario_id, oferta_id) {
    document.getElementById('id_test').value = id;
    document.getElementById('resultado').value = resultado;
    // No intentamos asignar un valor al input de tipo file
    document.getElementById('usuario_id').value = usuario_id;
    document.getElementById('oferta_id').value = oferta_id;

    // Mostrar vista previa de la imagen actual si existe
    if (imagen_test) {
        document.getElementById('imagenActual').innerHTML = 
            '<p>Imagen actual:</p><img src="' + imagen_test + '" alt="Imagen de la oferta" style="max-width: 200px;">';
    } else {
        document.getElementById('imagenActual').innerHTML = '<p>No hay imagen actual.</p>';
    }

    document.getElementById('crearBtn').classList.add('d-none');
    document.getElementById('actualizarBtn').classList.remove('d-none');
    document.getElementById('cancelarBtn').classList.remove('d-none');
    var myModal = new bootstrap.Modal(document.getElementById('categoryModal'), {});
    myModal.show();
}


function cancelarEdicion() {
    document.getElementById('id_test').value = '';
    document.getElementById('resultado').value = '';
    document.getElementById('imagen_test').value = '';
    document.getElementById('usuario_id').value = '';
    document.getElementById('oferta_id').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


