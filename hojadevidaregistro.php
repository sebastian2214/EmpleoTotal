<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Formulario de Registro</h2>
        <form method="POST" action="procesar_formulario.php">
            <input type="hidden" name="usuario_id_usuario" value="1"> <!-- Asumiendo que el ID del usuario es 1 -->
            <div class="modal-body">
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
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo">
                </div>
                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <input type="text" class="form-control" id="estado_civil" name="estado_civil">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                </div>
                <div class="form-group">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">
                </div>
                <div class="form-group">
                    <label for="descripcion_sobre_ti">Descripción sobre ti</label>
                    <textarea class="form-control" id="descripcion_sobre_ti" name="descripcion_sobre_ti" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="objetivo_profecional">Objetivo Profesional</label>
                    <textarea class="form-control" id="objetivo_profecional" name="objetivo_profecional" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="idiomas">Idiomas</label>
                    <input type="text" class="form-control" id="idiomas" name="idiomas">
                </div>
                <div class="form-group">
                    <label for="referencias">Referencias</label>
                    <input type="text" class="form-control" id="referencias" name="referencias">
                </div>
                <div class="form-group">
                    <label for="parentezco">Parentezco</label>
                    <input type="text" class="form-control" id="parentezco" name="parentezco">
                </div>
                <div class="form-group">
                    <label for="numero_referencia">Número de Referencia</label>
                    <input type="text" class="form-control" id="numero_referencia" name="numero_referencia">
                </div>
                <div class="form-group">
                    <label for="intereses_personales">Intereses Personales</label>
                    <input type="text" class="form-control" id="intereses_personales" name="intereses_personales">
                </div>
                <div class="form-group">
                    <label for="disponibilidad_trabajo">Disponibilidad de Trabajo</label>
                    <input type="text" class="form-control" id="disponibilidad_trabajo" name="disponibilidad_trabajo">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>
