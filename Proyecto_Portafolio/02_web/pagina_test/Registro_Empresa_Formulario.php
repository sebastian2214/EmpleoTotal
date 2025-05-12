<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID del usuario de la URL
$id_usuario = $_GET['id_usuario'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Registro Empresa</title>
    <link rel="stylesheet" href="Registro_Empresa_Formulario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Función para validar el formulario
        function validarFormulario(event) {
            let nombre = document.getElementById('nombre_emp').value;
            let industria = document.getElementById('industria').value;
            let correo = document.getElementById('correo').value;
            let descripcion = document.getElementById('descripcion_emp').value;
            let mision = document.getElementById('mision').value;
            let mision = document.getElementById('vision').value;

            // Validar Nombre de la Empresa (no vacío, solo letras y espacios)
            if (!/^[a-zA-Z\s]+$/.test(nombre)) {
                alert("Por favor, ingrese un nombre de empresa válido (solo letras y espacios).");
                event.preventDefault();
                return false;
            }

            // Validar Industria (palabras coherentes)
            if (!/^[a-zA-Z\s]+$/.test(industria)) {
                alert("Por favor, ingrese una industria válida (solo letras y espacios).");
                event.preventDefault();
                return false;
            }

            // Validar Correo Electrónico
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
                alert("Por favor, ingrese un correo electrónico válido.");
                event.preventDefault();
                return false;
            }

            // Validar Descripción (mínimo 10 caracteres)
            if (descripcion.length < 50) {
                alert("La descripción de la empresa debe tener al menos 50 caracteres.");
                event.preventDefault();
                return false;
            }
           
            if (mision.length < 50) {
                alert("La mision de la empresa debe tener al menos 50 caracteres.");
                event.preventDefault();
                return false;
            }
            
            if (vision.length < 50) {
                alert("La vision de la empresa debe tener al menos 50 caracteres.");
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>

</head>
<body>

<header>
    <img class="logo" src="imagenes/logoTotal.png" alt="Logo de la empresa">
</header>

<main>
    <section class="formulario">
        <h1>Registrar Empresa</h1>
        <form method="POST" action="Registrar_Empresa.php" onsubmit="return validarFormulario(event)" class="needs-validation">
            <input type="hidden" name="usuario_id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
           
            <article class="campo">  
                <label for="nombre_emp" class="form__label">Nombre de la Empresa:</label>
                <input type="text" name="nombre_emp" id="nombre_emp" class="datos" required><br>
            </article>    
            <article class="campo">            
                <label for="industria" class="form__label">Industria:</label>
                <input type="text" name="industria" id="industria" class="datos" required><br>
            </article>
            <article class="campo">            
                <label for="ubicacion" class="form__label">Ubicación:</label>
                <input type="text" name="ubicacion" id="ubicacion" class="datos" required><br>
            </article>
            <article class="campo">            
                <label for="tamano_emp" class="form__label">Tamaño de la Empresa:</label>
                <select name="tamano_emp" id="tamano_emp" class="form-select" required>
                <option value="">Seleccione una opción</option>
                <option value="Microempresa">Microempresa</option>
                <option value="Pequeña y mediana empresa">Pequeña y mediana empresa</option>
                <option value="Gran empresa">Gran empresa</option>
            </select><br>
            </article>
            <article class="campo">            
                <label for="descripcion_emp" class="form__label">Descripción de la Empresa:</label>
                <input type="text" name="descripcion_emp" id="descripcion_emp" class="datos" required><br>
            </article>
            <article class="campo">            
                <label for="contacto" class="form__label">Contacto:</label>
                <input type="number" name="contacto" id="contacto" class="datos" required><br>
            </article>
            <article class="campo">            
                <label for="correo" class="form__label">Correo de la Empresa:</label>
                <input type="email" name="correo" id="correo" class="datos" required><br>
            </article>
            <article class="campo">            
                <label for="sitio_web_of" class="form__label">Sitio Web Oficial:</label>
                <input type="text" name="sitio_web_of" id="sitio_web_of" class="datos" required><br>
            </article>
            <article class="campo">            
                <label for="antecedentes" class="form__label">Antecedentes:</label>
                <textarea name="antecedentes" id="antecedentes" class="datos" required></textarea><br>
            </article>
            <article class="campo">            
                <label for="mision" class="form__label">Misión:</label>
                <textarea name="mision" id="mision" class="datos" required></textarea><br>
            </article>
            <article class="campo">            
                <label for="vision" class="form__label">Visión:</label>
                <textarea name="vision" id="vision" class="datos" required></textarea><br>
            </article>
            <article class="campo">            
                <label for="regionales" class="form__label">Regionales:</label>
                <select name="regionales" id="regionales" class="form-select" required>
                <option value="">Seleccione una opción</option>
                <option value="Bogotá">Bogotá</option>
                <option value="Medellín">Medellín</option>
                <option value="Cali">Cali</option>
                <option value="Barranquilla">Barranquilla</option>
                <option value="Cartagena">Cartagena</option>
                <option value="Bucaramanga">Bucaramanga</option>
            </select>
            </article>
            <article class="campo">            
                <label for="hitos_significativos" class="form__label">Hitos Significativos:</label>
                <textarea name="hitos_significativos" id="hitos_significativos" class="datos" required></textarea><br>
            </article>
            <article class="campo">            
                <label for="innovaciones_recientes" class="form__label">Innovaciones Recientes:</label>
                <textarea name="innovaciones_recientes" id="innovaciones_recientes" class="datos" required></textarea><br>
            </article>
            <article class="campo">            
                <label for="beneficios_empleados" class="form__label">Beneficios para Empleados:</label>
                <textarea name="beneficios_empleados" id="beneficios_empleados" class="datos" required></textarea><br>
            </article>
            <article class="btn-envio">
            <input type="submit" value="Guardar Empresa">
</article>
        </form>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
