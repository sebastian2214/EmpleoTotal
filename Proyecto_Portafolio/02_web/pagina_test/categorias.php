<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Categorias</title>
    <link rel="stylesheet" href=".//categorias/categorias.css">
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
    

    <div id="alert-container" class="container mt-3"></div>

    <main class="content">
        <section id="inicio" class="page py-4 bg-light" style="display:block;">
        <h3 class="text-center mb-8">Buscar Categorias</h3>
            <form class="form-inline mb-4" method="POST" action="">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" id="searchInputCategorias" name="search" placeholder="Buscar Categorías" value="<?php echo htmlspecialchars(isset($_POST['search']) ? $_POST['search'] : ''); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Buscar Categorías</button>
            </form>

            <h2 class="mb-4">Listado de Categorías</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="categoriasTableBody">
                        <?php
                        include_once "conexion.php";

                        function buscarCategorias($search = '') {
                            global $base_de_datos;
                            $sql = "SELECT * FROM categoria WHERE nombre_cat LIKE :search";
                            $stmt = $base_de_datos->prepare($sql);
                            $stmt->execute([':search' => "%$search%"]);
                            return $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
                            $action = $_POST['action'];
                            $id_categora = $_POST['id_categora'] ?? null;
                            $nombre_cat = $_POST['nombre_cat'];

                            if ($action == 'delete') {
                                $sql = "DELETE FROM categoria WHERE id_categora = :id_categora";
                                $stmt = $base_de_datos->prepare($sql);
                                $stmt->execute([':id_categora' => $id_categora]);
                            } elseif ($action == 'update') {
                                $sql = "UPDATE categoria SET nombre_cat = :nombre_cat WHERE id_categora = :id_categora";
                                $stmt = $base_de_datos->prepare($sql);
                                $stmt->execute([
                                    ':nombre_cat' => $nombre_cat,
                                    ':id_categora' => $id_categora,
                                ]);
                            } elseif ($action == 'add') {
                                $sql = "INSERT INTO categoria (nombre_cat) VALUES (:nombre_cat)";
                                $stmt = $base_de_datos->prepare($sql);
                                $stmt->execute([':nombre_cat' => $nombre_cat]);
                            }
                            header('Location: ' . $_SERVER['PHP_SELF']);
                            exit();
                        }

                        $search = isset($_POST['search']) ? $_POST['search'] : '';
                        $categorias = buscarCategorias($search);

                        if ($categorias) {
                            foreach ($categorias as $categoria) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($categoria['id_categora']) . "</td>";
                                echo "<td>" . htmlspecialchars($categoria['nombre_cat']) . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-warning' onclick='editCategory(" . htmlspecialchars($categoria['id_categora']) . ", \"" . htmlspecialchars($categoria['nombre_cat']) . "\")'>Editar</button> ";
                                echo "<button class='btn btn-danger' onclick='deleteCategory(" . htmlspecialchars($categoria['id_categora']) . ")'>Eliminar</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No hay categorías disponibles.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="showAddCategoryForm()">Agregar Categoría</button>
        </section>
    </main>

    <!-- Modal para agregar y editar categoría -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Agregar / Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" method="POST">
                        <input type="hidden" name="id_categora" id="id_categora">
                        <input type="hidden" name="action" id="formAction">
                        <div class="mb-3">
                            <label for="nombre_cat" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_cat" name="nombre_cat" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src=".//categorias/categorias.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showAddCategoryForm() {
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryModalLabel').innerText = 'Agregar Categoría';
            document.getElementById('formAction').value = 'add';
            var myModal = new bootstrap.Modal(document.getElementById('categoryModal'));
            myModal.show();
        }

        function editCategory(id, nombre) {
            document.getElementById('id_categora').value = id;
            document.getElementById('nombre_cat').value = nombre;
            document.getElementById('categoryModalLabel').innerText = 'Editar Categoría';
            document.getElementById('formAction').value = 'update';
            var myModal = new bootstrap.Modal(document.getElementById('categoryModal'));
            myModal.show();
        }

        function deleteCategory(id) {
            if (confirm('¿Estás seguro de que quieres eliminar esta categoría?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id_categora';
                input.value = id;
                form.appendChild(input);
                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'delete';
                form.appendChild(actionInput);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
