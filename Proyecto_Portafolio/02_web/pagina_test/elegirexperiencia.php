<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID de la hoja de vida de la URL
$id_hojade_de_vida = $_GET['hojade_de_vida_id_hojade_de_vida'] ?? '';

// Validar que el ID esté presente antes de continuar
if (!$id_hojade_de_vida) {
    echo "Error: No se encontró el ID de hoja de vida.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Experiencia</title>
    <link rel="stylesheet" href="RegistroEstudios.css">
</head>
<body>

<header>
    <img class="logo" src="imagenes/logoTotal.png" alt="Logo de la empresa">
</header>

<main>
    <section class="formulario">
        <h1>Registrar Experiencia</h1>
        <form method="POST" action="registrarexperiencia.php">
            <!-- Campo oculto para enviar el id de la hoja de vida -->
            <input type="hidden" name="hojade_de_vida_id_hojade_de_vida" value="<?php echo htmlspecialchars($id_hojade_de_vida); ?>">
            
            <!-- Campos del formulario -->
            <article class="campo">
                <label for="empresa" class="form__label">Empresa</label>
                <input type="text" name="empresa" id="empresa" class="datos" required><br>
            </article>
            <article class="campo">
                <label for="cargo" class="form__label">Cargo:</label>
                <input type="text" name="cargo" id="cargo" class="datos" required><br>
            </article>
            <article class="campo">
                <label for="ubicacion_empleo" class="form__label">Ubicación:</label>
                <input type="text" name="ubicacion_empleo" id="ubicacion_empleo" class="datos" required><br>
            </article>
            <article class="campo">
                <label for="descripcion_labor" class="form__label">Descripción laboral:</label>
                <input type="text" name="descripcion_labor" id="descripcion_labor" class="datos" required><br>
            </article>
            <article class="campo">
                <label for="fecha_inicio" class="form__label">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="datos" required><br>
            </article>
            <article class="campo">
                <label for="fecha_fin" class="form__label">Fecha de Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="datos" required><br>
            </article>  
            
            <article class="btn-envio">
                <input type="submit" value="Guardar Experiencia">
            </article>
        </form>
    </section>
</main>

<script>
document.querySelector("form").addEventListener("submit", function(event) {
    let fecha_inicio = document.getElementById("fecha_inicio").value;
    let fecha_fin = document.getElementById("fecha_fin").value;
    let fecha_actual = new Date();
    let fecha_inicio_obj = new Date(fecha_inicio);
    let fecha_fin_obj = new Date(fecha_fin);

    // Convertir fecha_actual a formato sin horas para comparación
    fecha_actual.setHours(0, 0, 0, 0);

    // Validar fecha de inicio: no puede ser igual a hoy, ni posterior a hoy, ni igual o posterior a la fecha fin
    if (fecha_inicio_obj.getTime() === fecha_actual.getTime()) {
        alert("La fecha de inicio no puede ser igual a la fecha actual.");
        event.preventDefault();
        return;
    }

    if (fecha_inicio_obj > fecha_actual) {
        alert("La fecha de inicio no puede ser posterior a la fecha actual.");
        event.preventDefault();
        return;
    }

    if (fecha_inicio_obj >= fecha_fin_obj) {
        alert("La fecha de inicio no puede ser igual o posterior a la fecha de fin.");
        event.preventDefault();
        return;
    }

    // Validar fecha de fin: no puede ser superior a hoy, ni inferior a la fecha de inicio, ni igual a la fecha de hoy
    if (fecha_fin_obj.getTime() === fecha_actual.getTime()) {
        alert("La fecha de fin no puede ser igual a la fecha actual.");
        event.preventDefault();
        return;
    }

    if (fecha_fin_obj > fecha_actual) {
        alert("La fecha de fin no puede ser superior a la fecha actual.");
        event.preventDefault();
        return;
    }

    if (fecha_fin_obj < fecha_inicio_obj) {
        alert("La fecha de fin no puede ser inferior a la fecha de inicio.");
        event.preventDefault();
        return;
    }
});
</script>

</body>
</html>
