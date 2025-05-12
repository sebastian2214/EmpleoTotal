<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID de la hoja de vida de la URL
$id_hojade_de_vida = $_GET['id_hojade_de_vida'] ?? '';

// Validar que el ID esté presente antes de continuar
if (!$id_hojade_de_vida) {
    echo "Error: No se encontró el ID de hoja de vida.";
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $institucion = $_POST['intitucion'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';

    // Validar que todos los campos estén presentes
    if (empty($institucion) || empty($titulo) || empty($fecha_inicio) || empty($fecha_fin)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Validar institución
    $institucionesRealistas = ["Universidad Nacional", "Universidad de Los Andes", "Pontificia Universidad Javeriana", "Universidad del Rosario"];
    if (!in_array($institucion, $institucionesRealistas)) {
        echo "El nombre de la institución no es realista. Por favor, ingresa un nombre válido.";
        exit();
    }

    // Validar título
    $titulosRealistas = ["Licenciatura en Ciencias Sociales", "Ingeniería de Sistemas", "Medicina", "Derecho", "Arquitectura"];
    if (!in_array($titulo, $titulosRealistas)) {
        echo "El título no es realista. Por favor, ingresa un título válido.";
        exit();
    }

    // Validar fechas
    $fecha_actual = new DateTime();
    $fecha_inicio_obj = new DateTime($fecha_inicio);
    $fecha_fin_obj = new DateTime($fecha_fin);

    // La fecha de inicio no puede ser posterior a la fecha actual
    if ($fecha_inicio_obj > $fecha_actual) {
        echo "La fecha de inicio no puede ser posterior a la fecha actual.";
        exit();
    }

    // La fecha de fin no puede ser anterior a la fecha de inicio
    if ($fecha_fin_obj < $fecha_inicio_obj) {
        echo "La fecha de fin no puede ser anterior a la fecha de inicio.";
        exit();
    }

    // Validar que la fecha de fin no sea demasiado lejana (por ejemplo, un máximo de 8 años)
    $fechaFinEsperada = clone $fecha_inicio_obj;
    $fechaFinEsperada->modify('+8 years');
    if ($fecha_fin_obj > $fechaFinEsperada) {
        echo "La fecha de fin no es válida. El título debería durar entre 3 y 8 años.";
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Estudios</title>
    <link rel="stylesheet" href="RegistroEstudios.css">
</head>
<body>

<header>
    <img class="logo" src="imagenes/logoTotal.png" alt="Logo de la empresa">
</header>

<main>
    <section class="formulario">
        <h1>Registrar Estudios</h1>
        <form method="POST" action="Registrar_Estudios.php">
            <!-- Campo oculto para enviar el id de la hoja de vida -->
            <input type="hidden" name="hojade_de_vida_id_hojade_de_vida" value="<?php echo htmlspecialchars($id_hojade_de_vida); ?>">
            
            <!-- Campos del formulario -->
            <article class="campo">
                <label for="institucion" class="form__label">Institución:</label>
                <input type="text" name="intitucion" id="intitucion" class="datos" required><br>
            </article>
            <article class="campo">
                <label for="titulo" class="form__label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="datos" required><br>
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
                <input type="submit" value="Guardar Estudios">
            </article>
        </form>
    </section>
</main>

<script>
document.querySelector("form").addEventListener("submit", function(event) {
    let institucion = document.getElementById("intitucion").value;
    let titulo = document.getElementById("titulo").value;
    
    let fecha_actual = new Date();
    let fecha_inicio_obj = new Date(fecha_inicio);
    let fecha_fin_obj = new Date(fecha_fin);

    // Validar institución
    let institucionesRealistas = ["Universidad Nacional", "Universidad de Los Andes", "Pontificia Universidad Javeriana", "Universidad del Rosario"]; // Puedes agregar más nombres aquí.
    if (!institucionesRealistas.includes(institucion)) {
        alert("El nombre de la institución no es realista. Por favor, ingresa un nombre válido.");
        event.preventDefault(); // Evita el envío del formulario
        return;
    }

    // Validar título
    let titulosRealistas = ["Licenciatura en Ciencias Sociales", "Ingeniería de Sistemas", "Medicina", "Derecho", "Arquitectura"]; // Puedes agregar más títulos aquí.
    if (!titulosRealistas.includes(titulo)) {
        alert("El título no es realista. Por favor, ingresa un título válido.");
        event.preventDefault(); // Evita el envío del formulario
        return;
    }

});


</script>

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

