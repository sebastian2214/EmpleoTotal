<?php
include('../../conexion.php');

// Obtener usuarios
$query = "SELECT id_usuario, usuario FROM usuario WHERE rol_id_rol = 2";
$stmt = $base_de_datos->query($query);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empresa - EmpleoTotal</title>
    <link rel="stylesheet" href="../../estilos/form_estilos.css">
    <style>
        /* Estilos adicionales para tres columnas y más compacto */
        .formulario .form-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Reduce el espacio entre las columnas */
            margin-bottom: 20px;
        }

        .formulario .form-column {
            flex: 1 1 30%; /* Tres columnas */
            margin-bottom: 15px;
        }

        .formulario input,
        .formulario select,
        .formulario textarea {
            width: 100%;
            padding: 8px; /* Reduce el padding para hacerlo más compacto */
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px; /* Tamaño de fuente reducido */
        }

        .formulario textarea {
            resize: vertical;
        }

        .formulario textarea:focus,
        .formulario input:focus,
        .formulario select:focus {
            border-color: #6C3483;
            outline: none;
        }

        /* Ajustes de estilo para mejorar la visualización */
        .formulario h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #6C3483;
        }

        .form-group label {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .btn-agregar {
            width: 100%;
            padding: 12px 20px;
            font-size: 16px;
            background-color: #6C3483;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-agregar:hover {
            background-color: #512e5f;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="guardar_empresa.php" method="POST" class="formulario">
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Agregar Nueva Empresa</h2>

        <div class="form-columns">
            <!-- Columna Izquierda -->
            <div class="form-column">
                <div class="form-group">
                    <label for="nombre_emp">Nombre de la Empresa</label>
                    <input type="text" id="nombre_emp" name="nombre_emp" required>
                </div>

                <div class="form-group">
                    <label for="industria">Industria</label>
                    <input type="text" id="industria" name="industria" required>
                </div>

                <div class="form-group">
                    <label for="ubicacion">Ubicación</label>
                    <input type="text" id="ubicacion" name="ubicacion" required>
                </div>

                <div class="form-group">
                    <label for="tamano_emp">Tamaño de la Empresa</label>
                    <input type="text" id="tamano_emp" name="tamano_emp">
                </div>

                <div class="form-group">
                    <label for="contacto">Contacto</label>
                    <input type="text" id="contacto" name="contacto">
                </div>

                <div class="form-group">
                    <label for="usuario_id_usuario">Usuario Asociado</label>
                    <select id="usuario_id_usuario" name="usuario_id_usuario" required>
                        <option value="">Seleccionar usuario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['usuario']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Columna del Centro -->
            <div class="form-column">
                <div class="form-group">
                    <label for="descripcion_emp">Descripción</label>
                    <textarea id="descripcion_emp" name="descripcion_emp"></textarea>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" id="correo" name="correo">
                </div>

                <div class="form-group">
                    <label for="sitio_web_of">Sitio Web Oficial</label>
                    <input type="text" id="sitio_web_of" name="sitio_web_of">
                </div>

                <div class="form-group">
                    <label for="antecedentes">Antecedentes</label>
                    <textarea id="antecedentes" name="antecedentes"></textarea>
                </div>

                <div class="form-group">
                    <label for="mision">Misión</label>
                    <textarea id="mision" name="mision"></textarea>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="form-column">
                <div class="form-group">
                    <label for="vision">Visión</label>
                    <textarea id="vision" name="vision"></textarea>
                </div>

                <div class="form-group">
                    <label for="regionales">Regionales</label>
                    <input type="text" id="regionales" name="regionales">
                </div>

                <div class="form-group">
                    <label for="hitos_significativos">Hitos Significativos</label>
                    <textarea id="hitos_significativos" name="hitos_significativos"></textarea>
                </div>

                <div class="form-group">
                    <label for="innovaciones_recientes">Innovaciones Recientes</label>
                    <textarea id="innovaciones_recientes" name="innovaciones_recientes"></textarea>
                </div>

                <div class="form-group">
                    <label for="beneficios_empleados">Beneficios para Empleados</label>
                    <textarea id="beneficios_empleados" name="beneficios_empleados"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-agregar">Agregar Empresa</button>
    </form>
</div>

</body>
</html>
