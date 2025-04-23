<?php
// Incluir el archivo de conexión
include 'conexion.php';
session_start(); // Iniciar la sesión

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $usuario = $_POST['usuario'] ?? '';  // Si no existe, valor vacío
    $contrasena = $_POST['contrasena'] ?? '';  // Obtener la contraseña

    // Verificar si las variables no están vacías
    if (!empty($usuario) && !empty($contrasena)) {
        // Consulta para verificar las credenciales
        $sql = "SELECT * FROM usuario WHERE usuario = :usuario";
        $stmt = $base_de_datos->prepare($sql); // Usar la conexión establecida
        $stmt->execute(['usuario' => $usuario]); // Ejecutar la consulta
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el usuario existe y la contraseña es válida
        if ($user_data && password_verify($contrasena, $user_data['contrasena'])) {
            // Guardar los datos del usuario en la sesión
            $_SESSION['id_usuario'] = $user_data['id_usuario']; // ID del usuario
            $_SESSION['usuario'] = $user_data['usuario']; // Nombre de usuario
            $_SESSION['rol_id_rol'] = $user_data['rol_id_rol']; // Rol del usuario

            // Redirigir según el rol del usuario
            if ($user_data['rol_id_rol'] == 1) {
                header('Location: inicio.html'); // Redirigir a Admin
            } elseif ($user_data['rol_id_rol'] == 2) {
                header('Location: index.php');  // Redirigir a Usuario
            } else {
                header('Location: inicio.php'); // Redirigir a Invitado
            }
            exit();
        } else {
            // Mostrar mensaje de error si la autenticación falla
            echo '<script>alert("Usuario o contraseña incorrectos");</script>';
        }
    } else {
        echo '<script>alert("Por favor complete todos los campos");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="./Inicio_Sesio.css?v=<?php echo time(); ?>">
</head>

<body>

    <header>
        <img class="logo" src="imagenes/logoTotal.png" alt="Logo de la empresa">
    </header>

    <main>
        <section class="formulario">
            <h1>Iniciar Sesión</h1>
            <form action="Inicio_Sesion.php" method="post">
                <article class="campo">
                    <input type="text" name="usuario" class="datos" id="usuario" placeholder="usuario" required>
                    <label for="usuario" class="form__label">Usuario</label>
                </article>
                <article class="campo">
                    <input type="password" name="contrasena" id="contrasena" class="datos" placeholder="contraseña" required>
                    <label for="contrasena" class="form__label">Contraseña</label>
                </article>
                <article class="btn">
                    <input type="submit" value="Iniciar Sesión">
                </article>
                <article class="registrar">
                    <a href="EscogerRegistro.php">Registrarse</a>
                </article>
            </form>
        </section>
    </main>
</body>

</html>
