<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Roles</title>
    <link rel="stylesheet" href=".//rol/rol.css">
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
        <a href="categorias.php">Categorias</a>
        <a href="subcategorias.php">Sub Categorias</a>
        <a href="rol.php">Rol</a>
        <a href="estudios.php">Estudios</a>
        <a href="hoja_de_vida.php">Hoja de vida</a>
        <a href="notificaciones.php">Notificaciones</a>
        <a href="calificacion.php">Calificaciones</a>

    </aside>
    
    

    <main class="content">
        <div class="container mt-3">
<h3 class="text-center mb-8">Buscar Roles</h3>

    <form class="mb-4">
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="Buscar roles" aria-label="Buscar usuarios">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="button">Buscar</button>
                    </div>
                </form>

            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Nuevo Rol</button>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="rolesTableBody">
                        <?php
                        include_once "conexion.php";

                        function buscarRoles($search = '') {
                            global $base_de_datos;
                            $sql = "SELECT * FROM rol WHERE nombre_rol LIKE :search";
                            $stmt = $base_de_datos->prepare($sql);
                            $stmt->execute([':search' => "%$search%"]);
                            return $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
                            $action = $_POST['action'];
                            $id_rol = $_POST['id_rol'] ?? null;
                            $nombre_rol = $_POST['nombre_rol'];

                            if ($action == 'delete') {
                                $sql = "DELETE FROM rol WHERE id_rol = :id_rol";
                                $stmt = $base_de_datos->prepare($sql);
                                $stmt->execute([':id_rol' => $id_rol]);
                            } elseif ($action == 'update') {
                                $sql = "UPDATE rol SET nombre_rol = :nombre_rol WHERE id_rol = :id_rol";
                                $stmt = $base_de_datos->prepare($sql);
                                $stmt->execute([
                                    ':nombre_rol' => $nombre_rol,
                                    ':id_rol' => $id_rol,
                                ]);
                            } elseif ($action == 'add') {
                                $sql = "INSERT INTO rol (nombre_rol) VALUES (:nombre_rol)";
                                $stmt = $base_de_datos->prepare($sql);
                                $stmt->execute([':nombre_rol' => $nombre_rol]);
                            }
                            header('Location: ' . $_SERVER['PHP_SELF']);
                            exit();
                        }

                        $search = isset($_POST['search']) ? $_POST['search'] : '';
                        $roles = buscarRoles($search);

                        if ($roles) {
                            foreach ($roles as $rol) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($rol['id_rol']) . "</td>";
                                echo "<td>" . htmlspecialchars($rol['nombre_rol']) . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-warning' onclick='editRole(" . htmlspecialchars($rol['id_rol']) . ", \"" . htmlspecialchars($rol['nombre_rol']) . "\")'>Editar</button> ";
                                echo "<button class='btn btn-danger' onclick='deleteRole(" . htmlspecialchars($rol['id_rol']) . ")'>Eliminar</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>No se encontraron roles.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para agregar un nuevo rol -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Agregar Nuevo Rol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nombre_rol" class="form-label">Nombre del Rol</label>
                                <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" required>
                            </div>
                            <input type="hidden" name="action" value="add">
                            <button type="submit" class="btn btn-primary">Agregar Rol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar un rol -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Rol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="edit_nombre_rol" class="form-label">Nombre del Rol</label>
                                <input type="text" class="form-control" id="edit_nombre_rol" name="nombre_rol" required>
                            </div>
                            <input type="hidden" name="id_rol" id="edit_id_rol">
                            <input type="hidden" name="action" value="update">
                            <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <script src=".//rol/rol.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function editRole(id, nombre) {
                document.getElementById('edit_id_rol').value = id;
                document.getElementById('edit_nombre_rol').value = nombre;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            }

            function deleteRole(id) {
                if (confirm('¿Estás seguro de que quieres eliminar este rol?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '';
                    const actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = 'delete';
                    form.appendChild(actionInput);
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'id_rol';
                    idInput.value = id;
                    form.appendChild(idInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
    </main>
</body>
</html>
