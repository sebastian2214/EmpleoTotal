<?php
// Agregar usuario en la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include('../../conexion.php');

    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; // Contraseña ingresada por el usuario
    $rol_id_rol = $_POST['rol_id_rol'];

    // Cifrar la contraseña antes de guardarla
    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuario (usuario, correo, contrasena, rol_id_rol) VALUES (?, ?, ?, ?)";
    $stmt = $base_de_datos->prepare($query);
    $stmt->execute([$usuario, $correo, $contrasena_cifrada, $rol_id_rol]);

    // Redirigir al listado de usuarios después de agregar
    header("Location: usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario - EmpleoTotal</title>
    <link rel="stylesheet" href="../../estilos/form_estilos.css">
</head>
<body>

<!-- Contenedor principal con el formulario centrado -->
<div class="container">

    <!-- Formulario de agregar usuario -->
    <div class="formulario">
        <!-- Logo en la esquina derecha dentro del formulario -->
        <div class="logo-minimal">
            <img src="../../imagenes/logoTotal.png" alt="EmpleoTotal">
        </div>

        <h2>Agregar Nuevo Usuario</h2>
        <form action="guardar_usuario.php" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol_id_rol" required>
                    <option value="1">Admin</option>
                    <option value="2">Empresa</option>
                    <option value="3">Usuario</option>
                </select>
            </div>
            <button type="submit" class="btn-agregar">Agregar Usuario</button>
        </form>
    </div>

</div>

</body>
</html>

