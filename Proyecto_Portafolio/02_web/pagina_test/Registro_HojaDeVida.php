<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID del usuario desde la URL
$id_usuario = $_GET['id_usuario'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Registro Hoja de Vida</title>
    <link rel="stylesheet" href="Registro_HojaDeVida.css">
    <script>
        // Validación del formulario
        function validarFormulario() {
            // Validar nombre y apellido (realistas)
            const nombre = document.getElementById("nombre").value;
            const apellido = document.getElementById("apellido").value;
            const telefono = document.getElementById("telefono").value;
            const correo = document.getElementById("correo").value;
            const fechaNacimiento = new Date(document.getElementById("fecha_nacimiento").value);
            const nacionalidad = document.getElementById("nacionalidad").value;
            const idiomas = document.getElementById("idiomas").value;
            const parentezco = document.getElementById("parentezco").value;
            const numeroReferencia = document.getElementById("numero_referencia").value;
            const disponibilidadTrabajo = document.getElementById("disponibilidad_trabajo").value;

            // Validación de nombre y apellido
            const regexNombreApellido = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
            if (!regexNombreApellido.test(nombre) || !regexNombreApellido.test(apellido)) {
                alert("El nombre y apellido deben ser solo letras.");
                return false;
            }

            // Validación de teléfono (número realista de cualquier país)
const regexTelefono = /^\+?[1-9]\d{1,14}$/;
if (!regexTelefono.test(telefono)) {
    alert("El teléfono debe ser un número válido de cualquier país.");
    return false;
}


            // Validación de correo electrónico
            const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!regexCorreo.test(correo)) {
                alert("El correo electrónico no es válido, debe ser un realista.");
                return false;
            }

            // Validación de fecha de nacimiento (mayor de 18 años)
            const edad = new Date().getFullYear() - fechaNacimiento.getFullYear();
            if (edad < 18) {
                alert("Debes tener al menos 18 años.");
                return false;
            }

            // Validación de nacionalidad (solo palabras reales)
const regexNacionalidad = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
if (!regexNacionalidad.test(nacionalidad)) {
    alert("La nacionalidad debe ser una realista.");
    return false;
}


            // Validación de idiomas (idiomas realistas)
const regexIdioma = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
const idiomasArray = idiomas.split(",").map(idioma => idioma.trim());

for (let idioma of idiomasArray) {
    if (!regexIdioma.test(idioma)) {
        alert("Por favor ingresa un idioma válido (solo letras y espacios).");
        return false;
    }
}


         // Validación de parentezco (palabra realista sin necesidad de mayúsculas)
const parentescosValidos = ["padre", "madre", "hermano", "hermana", "amigo", "amiga", "tío", "tía", "abuelo", "abuela"];
const parentezcoLower = parentezco.toLowerCase();

if (!parentescosValidos.includes(parentezcoLower)) {
    alert("El parentesco debe ser uno válido: Padre, Madre, Hermano, Hermana, Amigo, Amiga, Tío, Tía, Abuelo, Abuela.");
    return false;
}


            // Validación del número de referencia (solo números)
            const regexNumeroReferencia = /^[0-9]+$/;
            if (!regexNumeroReferencia.test(numeroReferencia)) {
                alert("El número de referencia debe ser numérico.");
                return false;
            }

            // Validación de disponibilidad de trabajo (1-24 horas)
            const regexDisponibilidad = /^(1[0-9]|2[0-4]|[1-9])$/;
            if (!regexDisponibilidad.test(disponibilidadTrabajo)) {
                alert("La disponibilidad de trabajo debe ser entre 1 y 24 horas.");
                return false;
            }

            return true; // Si todas las validaciones son correctas
        }
    </script>
</head>
<body>

<header>
    <img class="logo" src="imagenes/logoTotal.png" alt="Logo de la empresa">
</header>

<main>
    <section class="formulario">
        <h1>Registrar Hoja de Vida</h1>
        <form method="POST" action="Registrar_HojaDeVida.php" onsubmit="return validarFormulario()">
            <input type="hidden" name="usuario_id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
            
            <article class="campo">   
                <label for="nombre" class="form__label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="datos"  required><br>
            </article>
            <article class="campo">  
                <label for="apellido" class="form__label">Apellido:</label>
                <input type="text" name="apellido" id="apellido" class="datos"  required><br>
            </article>
            <article class="campo"> 
                <label for="direccion" class="form__label">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="datos" ><br>
            </article>
            <article class="campo"> 
                <label for="telefono" class="form__label">Teléfono:</label>
                <input type="number" name="telefono" id="telefono" class="datos" ><br>
            </article>
            <article class="campo"> 
                <label for="correo" class="form__label">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" class="datos" ><br>
            </article>
            <article class="campo"> 
                <label for="estado_civil" class="form__label">Estado Civil:</label>
                <select name="estado_civil" id="estado_civil" class="datos">
                    <option value="">Seleccione una opción</option>
                    <option value="soltero" selected>Solter@</option>
                    <option value="casado">Casad@</option>
                    <option value="viudo">Viud@</option>
                </select>
                <br>
            </article>
            <article class="campo"> 
                <label for="fecha_nacimiento" class="form__label">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"  ><br>
            </article>
            <article class="campo"> 
                <label for="nacionalidad" class="form__label">Nacionalidad:</label>
                <input type="text" name="nacionalidad" id="nacionalidad" ><br>
            </article>
            <article class="campo"> 
                <label for="descripcion_sobre_ti" class="form__label">Descripción sobre ti:</label>
                <textarea name="descripcion_sobre_ti" id="descripcion_sobre_ti" class="datos"></textarea><br> 
            </article>
            <article class="campo"> 
                <label for="objetivo_profecional" class="form__label">Objetivo Profesional:</label>
                <textarea name="objetivo_profecional" id="objetivo_profecional" class="datos"></textarea><br>
            </article>
            <article class="campo"> 
                <label for="idiomas" class="form__label">Idiomas:</label>
                <input type="text" name="idiomas" id="idiomas" class="datos" ><br>
            </article>
            <article class="campo"> 
                <label for="referencias" class="form__label">Referencias:</label>
                <input type="text" name="referencias" id="referencias" class="datos" ><br>
            </article>
            <article class="campo"> 
                <label for="parentezco" class="form__label">Parentezco:</label>
                <input type="text" name="parentezco" id="parentezco" class="datos" ><br>
            </article>
            <article class="campo"> 
                <label for="numero_referencia" class="form__label">Número de Referencia:</label>
                <input type="number" name="numero_referencia" id="numero_referencia" class="datos"><br>
            </article>
            <article class="campo"> 
    <label for="disponibilidad_trabajo" class="form__label">Disponibilidad para trabajar (en horas):</label>
    <select name="disponibilidad_trabajo" id="disponibilidad_trabajo" class="datos">
        <option value="1">1 hora</option>
        <option value="2">2 horas</option>
        <option value="3">3 horas</option>
        <option value="4">4 horas</option>
        <option value="5">5 horas</option>
        <option value="6">6 horas</option>
        <option value="7">7 horas</option>
        <option value="8">8 horas</option>
        <option value="9">9 horas</option>
        <option value="10">10 horas</option>
        <option value="11">11 horas</option>
        <option value="12">12 horas</option>
        <option value="13">13 horas</option>
        <option value="14">14 horas</option>
        <option value="15">15 horas</option>
        <option value="16">16 horas</option>
        <option value="17">17 horas</option>
        <option value="18">18 horas</option>
        <option value="19">19 horas</option>
        <option value="20">20 horas</option>
        <option value="21">21 horas</option>
        <option value="22">22 horas</option>
        <option value="23">23 horas</option>
        <option value="24">24 horas</option>
    </select><br>
</article>
<article class="btn-envio">
                <input type="submit" value="Siguiente">
            </article>
        </form>
    </section>
</main>

</body>
</html>
