<!-- form_recuperar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>

<style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
        header {
            background-color: #5600c5;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        /* Footer */
        footer {
            background-color: #5600c5;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Contenedor principal */
        .container {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-form h1 {
            color: #5600c5;
            text-align: center;
        }

        /* Estilo de los campos de formulario */
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        button:focus {
            outline: none;
            border-color: #5600c5;
        }

        /* Estilo de los botones */
        button,
        .btn-outline-light {
            background-color: #5600c5;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        button:hover,
        .btn-outline-light:hover {
            background-color: #4500a3;
        }

        /* Contenedor del enlace y botón */
        .d-flex {
            display: flex;
            justify-content: space-between;
        }
    </style>

<body>
<div class="container">
        <div class="login-form">
            <h1 class="text-center">Recuperar Contraseña</h1>
            <form method="post" action="restablecer_contra.php">
                <p class="text-center">Introduce tu correo electrónico para enviar el token de recuperación.
                </p>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <button type="submit" class="btn btn-outline-light">Enviar</button>
                <button class="btn btn-outline-light" onclick="window.location.href='http://localhost:3000';">Cancelar</button>
            </form>
        </div>
    </div>
</body>
</html>
