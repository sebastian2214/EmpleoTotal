<?php
// Incluir el archivo de conexión
include 'conexion.php';

try {
    // Crear
    if (isset($_POST['crear'])) {
        if (!empty($_POST['titulo_emp']) && !empty($_POST['descripcion']) && !empty($_POST['requisitos']) && !empty($_POST['ubicacion']) && !empty($_POST['salario']) && !empty($_FILES['oferta_empleocol']['tmp_name']) && !empty($_POST['telefono']) && !empty($_POST['correo'])) {
            $titulo_emp = $_POST['titulo_emp'];
            $descripcion = $_POST['descripcion'];
            $requisitos = $_POST['requisitos'];
            $ubicacion = $_POST['ubicacion'];
            $salario = $_POST['salario'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $sub_cat_id_sub_cat = $_POST['sub_cat_id_sub_cat'];
    
            // Procesar la imagen
            $nombreImagen = $_FILES['oferta_empleocol']['name'];
            $rutaTemporal = $_FILES['oferta_empleocol']['tmp_name'];
            $rutaDestino = 'uploads/' . uniqid() . '_' . $nombreImagen;  // Ruta única
    
            // Mover la imagen a la carpeta del servidor
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                // Insertar en la base de datos
                $sql = "INSERT INTO oferta_empleo (titulo_emp, descripcion, requisitos, ubicacion, salario, oferta_empleocol, telefono, correo, sub_cat_id_sub_cat) 
                        VALUES (:titulo_emp, :descripcion, :requisitos, :ubicacion, :salario, :oferta_empleocol, :telefono, :correo, :sub_cat_id_sub_cat)";
                $stmt = $base_de_datos->prepare($sql);
                $stmt->execute([
                    ':titulo_emp' => $titulo_emp,
                    ':descripcion' => $descripcion,
                    ':requisitos' => $requisitos,
                    ':ubicacion' => $ubicacion,
                    ':salario' => $salario,
                    ':oferta_empleocol' => $rutaDestino,  // Guardar la ruta de la imagen
                    ':telefono' => $telefono,
                    ':correo' => $correo,
                    ':sub_cat_id_sub_cat' => $sub_cat_id_sub_cat,
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
            $sql = "SELECT * FROM oferta_empleo WHERE titulo_emp LIKE :buscar OR descripcion LIKE :buscar OR ubicacion LIKE :buscar";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':buscar' => '%' . $buscar . '%']);
        } else {
            // Consulta SQL sin filtro de búsqueda
            $sql = "SELECT * FROM oferta_empleo";
            $stmt = $base_de_datos->query($sql);
        }
    
        // Leer categorías para el <select>
        $sqlSubcat = "SELECT id_sub_cat, nombre_sub_cat FROM sub_cat";
        $stmtSubcat = $base_de_datos->query($sqlSubcat);
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Actualizar
    if (isset($_POST['actualizar'])) {
        if (!empty($_POST['titulo_emp']) && !empty($_POST['descripcion']) && !empty($_POST['requisitos']) && !empty($_POST['ubicacion']) && !empty($_POST['salario']) && !empty($_POST['telefono']) && !empty($_POST['correo'])) {
            $id_oferta_empleo = $_POST['id_oferta_empleo'];
            $titulo_emp = $_POST['titulo_emp'];
            $descripcion = $_POST['descripcion'];
            $requisitos = $_POST['requisitos'];
            $ubicacion = $_POST['ubicacion'];
            $salario = $_POST['salario'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $sub_cat_id_sub_cat = $_POST['sub_cat_id_sub_cat'];
    
            // Obtener la ruta de la imagen actual
            $sql = "SELECT oferta_empleocol FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([':id_oferta_empleo' => $id_oferta_empleo]);
            $rutaImagenActual = $stmt->fetchColumn();
    
            // Si se sube una nueva imagen
            if (!empty($_FILES['oferta_empleocol']['tmp_name'])) {
                $nombreImagen = $_FILES['oferta_empleocol']['name'];
                $rutaTemporal = $_FILES['oferta_empleocol']['tmp_name'];
                $rutaDestino = 'uploads/' . uniqid() . '_' . $nombreImagen;
    
                // Mover la nueva imagen al servidor
                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    // Eliminar la imagen anterior del servidor, si existe
                    if ($rutaImagenActual && file_exists($rutaImagenActual)) {
                        unlink($rutaImagenActual);
                    }
    
                    // Actualizar todos los campos, incluyendo la nueva imagen
                    $sql = "UPDATE oferta_empleo 
                            SET titulo_emp = :titulo_emp, 
                                descripcion = :descripcion, 
                                requisitos = :requisitos, 
                                ubicacion = :ubicacion, 
                                salario = :salario, 
                                oferta_empleocol = :oferta_empleocol, 
                                telefono = :telefono, 
                                correo = :correo, 
                                sub_cat_id_sub_cat = :sub_cat_id_sub_cat 
                            WHERE id_oferta_empleo = :id_oferta_empleo";
                    $stmt = $base_de_datos->prepare($sql);
                    $stmt->execute([
                        ':titulo_emp' => $titulo_emp,
                        ':descripcion' => $descripcion,
                        ':requisitos' => $requisitos,
                        ':ubicacion' => $ubicacion,
                        ':salario' => $salario,
                        ':oferta_empleocol' => $rutaDestino,  // Guardar la nueva ruta de la imagen
                        ':telefono' => $telefono,
                        ':correo' => $correo,
                        ':sub_cat_id_sub_cat' => $sub_cat_id_sub_cat,
                        ':id_oferta_empleo' => $id_oferta_empleo,
                    ]);
                } else {
                    $error_message = "Error al subir la nueva imagen.";
                }
            } else {
                // Si no hay imagen nueva, mantener la imagen anterior y actualizar los demás campos
                $sql = "UPDATE oferta_empleo 
                        SET titulo_emp = :titulo_emp, 
                            descripcion = :descripcion, 
                            requisitos = :requisitos, 
                            ubicacion = :ubicacion, 
                            salario = :salario, 
                            telefono = :telefono, 
                            correo = :correo, 
                            sub_cat_id_sub_cat = :sub_cat_id_sub_cat 
                        WHERE id_oferta_empleo = :id_oferta_empleo";
                $stmt = $base_de_datos->prepare($sql);
                $stmt->execute([
                    ':titulo_emp' => $titulo_emp,
                    ':descripcion' => $descripcion,
                    ':requisitos' => $requisitos,
                    ':ubicacion' => $ubicacion,
                    ':salario' => $salario,
                    ':telefono' => $telefono,
                    ':correo' => $correo,
                    ':sub_cat_id_sub_cat' => $sub_cat_id_sub_cat,
                    ':id_oferta_empleo' => $id_oferta_empleo,
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
        $id_oferta_empleo = $_GET['eliminar'];
    
        // Obtener la ruta de la imagen antes de eliminar
        $sql = "SELECT oferta_empleocol FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_oferta_empleo' => $id_oferta_empleo]);
        $rutaImagen = $stmt->fetchColumn();
    
        // Eliminar la oferta de la base de datos
        $sql = "DELETE FROM oferta_empleo WHERE id_oferta_empleo = :id_oferta_empleo";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([':id_oferta_empleo' => $id_oferta_empleo]);
    
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
    <title>Listado de Ofertas</title>
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
    <h3 class="text-center mb-8">Buscar Ofertas</h3>

    <form class="mb-4" method="POST" action="">
        <div class="mb-2">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar Ofertas" value="<?php echo htmlspecialchars($buscar); ?>" aria-label="Buscar ofertas">
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>


    <!-- Botón para agregar nueva subcategoría -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">Agregar Ofertas</button>

    <!-- Tabla para mostrar datos -->
    <div class="container table-responsive">
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Empresa</th>
            <th>Descripción</th>
            <th>Requisitos</th>
            <th>Ubicación</th>
            <th>Imagen Oferta</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Sub Categoria</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            // Obtener el nombre de la subcategoría correspondiente
            $sqlSubcatNombre = "SELECT nombre_sub_cat FROM sub_cat WHERE id_sub_cat = :id_sub_cat";
            $stmtSubcatNombre = $base_de_datos->prepare($sqlSubcatNombre);
            $stmtSubcatNombre->execute([':id_sub_cat' => $row['sub_cat_id_sub_cat']]);
            $subCatNombre = $stmtSubcatNombre->fetchColumn();
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id_oferta_empleo']); ?></td>
            <td><?php echo htmlspecialchars($row['titulo_emp']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($row['requisitos']); ?></td>
            <td><?php echo htmlspecialchars($row['ubicacion']); ?></td>
            <td>
                <!-- Mostrar la imagen de la oferta si existe -->
                <?php if (!empty($row['oferta_empleocol'])): ?>
                    <img src="<?php echo htmlspecialchars($row['oferta_empleocol']); ?>" alt="Imagen de la oferta" width="100">
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
            <td><?php echo htmlspecialchars($row['correo']); ?></td>
            <td><?php echo htmlspecialchars($subCatNombre); ?></td>
            <td>
                <button class="btn btn-warning" onclick="editarOferta(<?php echo htmlspecialchars($row['id_oferta_empleo']); ?>, '<?php echo htmlspecialchars($row['titulo_emp']); ?>', '<?php echo htmlspecialchars($row['descripcion']); ?>', '<?php echo htmlspecialchars($row['requisitos']); ?>', '<?php echo htmlspecialchars($row['ubicacion']); ?>', '<?php echo htmlspecialchars($row['salario']); ?>', '<?php echo htmlspecialchars($row['oferta_empleocol']); ?>', '<?php echo htmlspecialchars($row['telefono']); ?>', '<?php echo htmlspecialchars($row['correo']); ?>', <?php echo htmlspecialchars($row['sub_cat_id_sub_cat']); ?>)">Editar</button>
                <a href="?eliminar=<?php echo htmlspecialchars($row['id_oferta_empleo']); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta empresa?');">Eliminar</a>
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
            <form id="subCategoryForm" method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="id_oferta_empleo" id="id_oferta_empleo">
                    <div class="mb-3">
                        <label for="titulo_emp" class="form-label">Nombre Empresa</label>
                        <input type="text" class="form-control" id="titulo_emp" name="titulo_emp" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>

                    <div class="mb-3">
                        <label for="requisitos" class="form-label">Requisitos</label>
                        <input type="text" class="form-control" id="requisitos" name="requisitos" required>
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                    </div>

                    <div class="mb-3">
                        <label for="salario" class="form-label">Salario</label>
                        <input type="text" class="form-control" id="salario" name="salario" required>
                    </div>

                    <div id="imagenActual" class="mb-3"></div>

                    <div class="mb-3">
                        <label for="oferta_empleocol" class="form-label">Imagen Oferta</label>
                        <input type="file" class="form-control" id="oferta_empleocol" name="oferta_empleocol">
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
                        <label for="sub_cat_id_sub_cat" class="form-label">Sub Categoria</label>
                        <select class="form-select" id="sub_cat_id_sub_cat" name="sub_cat_id_sub_cat" required>
                            <option value="" selected disabled>Seleccione una Sub Categoria</option>
                            <?php
                            $stmtSubcat->execute();
                            while ($subCat = $stmtSubcat->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . htmlspecialchars($subCat['id_sub_cat']) . "\">" . htmlspecialchars($subCat['nombre_sub_cat']) . "</option>";
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
    <script src=".//ofertas/ofertas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function editarOferta(id, nombre, descripcion, requisitos, ubicacion, salario, oferta_empleocol, telefono, correo, subCat_id) {
    document.getElementById('id_oferta_empleo').value = id;
    document.getElementById('titulo_emp').value = nombre;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('requisitos').value = requisitos;
    document.getElementById('ubicacion').value = ubicacion;
    document.getElementById('salario').value = salario;
    // No intentamos asignar un valor al input de tipo file
    document.getElementById('telefono').value = telefono;
    document.getElementById('correo').value = correo;
    document.getElementById('sub_cat_id_sub_cat').value = subCat_id;

    // Mostrar vista previa de la imagen actual si existe
    if (oferta_empleocol) {
        document.getElementById('imagenActual').innerHTML = 
            '<p>Imagen actual:</p><img src="' + oferta_empleocol + '" alt="Imagen de la oferta" style="max-width: 200px;">';
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
    document.getElementById('id_oferta_empleo').value = '';
    document.getElementById('titulo_emp').value = '';
    document.getElementById('descripcion').value = '';
    document.getElementById('requisitos').value = '';
    document.getElementById('ubicacion').value = '';
    document.getElementById('oferta_empleocol').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('sub_cat_id_sub_cat').value = '';
    document.getElementById('crearBtn').classList.remove('d-none');
    document.getElementById('actualizarBtn').classList.add('d-none');
    document.getElementById('cancelarBtn').classList.add('d-none');
}
</script>
</body>
</html>


