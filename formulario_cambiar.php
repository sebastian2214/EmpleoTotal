<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
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

        h2.text-white {
            color: #5600c5;
            text-align: center;
        }

        /* Estilo de los campos de formulario */
        input[type="password"],
        input[type="text"],
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="password"]:focus,
        input[type="text"]:focus,
        button:focus {
            outline: none;
            border-color: #5600c5;
        }

        /* Estilo del botón */
        button {
            background-color: #5600c5;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #4500a3;
        }
    </style>

<body>
<div class="container">
      <h2 class="text-white">Restablecer contraseña</h2>
        <form action="procesar_cambio.php" method="post">
          <input type="password" name="nueva_contraseña" placeholder="Nueva contraseña" required>
          <input type="text" name="token" placeholder="Token">
          <button type="submit" class="btn btn-outline-light">Restablecer contraseña</button>
        </form>
    </div>
</body>
</html>
