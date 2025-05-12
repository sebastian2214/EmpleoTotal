<?php
// Iniciar sesión para asegurarnos de que está activa
session_start();

// Eliminar la cookie del token
if (isset($_COOKIE['token'])) {
    setcookie('token', '', time() - 3600, '/', '', false, true); // Expira la cookie
}

// Destruir las variables de sesión si existen
session_unset();
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header('Location: http://localhost:3000');
exit();
?>
