<?php
// Incluir el archivo de conexión
include 'conexion.php';
session_start(); // Iniciar la sesión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Validar que los campos no estén vacíos
    if (!empty($usuario) && !empty($correo) && !empty($contrasena)) {
        // Validar que el nombre sea realista
        if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}$/", $usuario)) {
            // Validar formato del correo
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                // Verificar si el dominio del correo tiene registros MX válidos
                $dominio = explode('@', $correo)[1];
                if (checkdnsrr($dominio, 'MX')) {
                    // Validar que la contraseña sea segura
                    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $contrasena)) {
                        try {
                            // Consulta para verificar si ya existe el nombre de usuario o el correo
                            $query = "SELECT COUNT(*) FROM usuario WHERE usuario = ? OR correo = ?";
                            $stmt = $base_de_datos->prepare($query);
                            $stmt->execute([$usuario, $correo]);
                            $count = $stmt->fetchColumn();

                            if ($count > 0) {
                                // Si ya existe el usuario o correo, mostrar un mensaje de error
                                echo '<div class="alert alert-danger" role="alert">El nombre de usuario o el correo ya están en uso. Por favor, elige otro.</div>';
                            } else {
                                // Si no existe, guardar los datos temporalmente en la sesión
                                $_SESSION['usuario'] = $usuario;
                                $_SESSION['correo'] = $correo;
                                $_SESSION['contrasena'] = password_hash($contrasena, PASSWORD_DEFAULT); // Encriptar la contraseña

                                // Redirigir al formulario de empresa
                                header("Location: Registro_HojaDeVida.php");
                                exit();
                            }
                        } catch (Exception $e) {
                            echo '<div class="alert alert-danger" role="alert">Error en la base de datos: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        }
                    } else {
                        // Contraseña no cumple con los requisitos de seguridad
                        echo '<div class="alert alert-danger" role="alert">La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, una letra minúscula, un número y un carácter especial.</div>';
                    }
                } else {
                    // Dominio no válido
                    echo '<div class="alert alert-danger" role="alert">El dominio del correo no es válido. Por favor, introduce un correo válido.</div>';
                }
            } else {
                // Formato de correo no válido
                echo '<div class="alert alert-danger" role="alert">Por favor, introduce un correo con un formato válido.</div>';
            }
        } else {
            // Nombre no cumple con los requisitos
            echo '<div class="alert alert-danger" role="alert">El nombre debe tener entre 3 y 50 caracteres y solo puede contener letras y espacios.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Por favor completa todos los campos.</div>';
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="Registrar_Usuario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<header>
    <img class="logo" src="imagenes/logoTotal.png" alt="Logo de la empresa">
</header>

<main>
    <section class="formulario">
        <h1>Registrar Usuario</h1>
        <form method="POST" action="Registro_Usuario.php">
            <article class="campo">   
                <input type="text" name="usuario" id="usuario" class="datos" placeholder="Usuario" required><br>  
                <label for="usuario" class="form__label">Nombre de Usuario:</label>
            </article>
            <article class="campo">  
                <input type="email" name="correo" id="correo" class="datos" placeholder="Correo" required><br>
                <label for="correo" class="form__label">Correo:</label>
            </article>
            <article class="campo"> 
                <input type="password" name="contrasena" id="contrasena" class="datos" placeholder="Contraseña" required><br>
                <label for="contrasena" class="form__label">Contraseña:</label>
            </article>
            <input type="submit" value="Registrarse">
        </form>
    </section>
</main>

</body>
</html>
