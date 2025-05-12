import React, { useState } from 'react';
import axios from 'axios';
import './Login.css'; // Asegúrate de tener el archivo CSS
import logo from './imagenes/logoTotal.png'; // Asegúrate de tener el logo en la carpeta adecuada

const Login = () => {
    const [usuario, setUsuario] = useState('');
    const [contrasena, setContrasena] = useState('');

    const handleLogin = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post(
                'http://localhost/pagina_test/api_login.php',
                { usuario, contrasena },
                { withCredentials: true } // Necesario para las cookies
            );

            if (response.data.success && response.data.redirect_url) {
                alert(response.data.message); // Mensaje de éxito
                window.location.href = `http://localhost/pagina_test/${response.data.redirect_url}`; // Redirigir según el rol
            } else {
                alert(response.data.message); // Mensaje de error
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
            alert('Hubo un problema al procesar la solicitud.');
        }
    };

    return (
        <div className="login-container">
            <header>
                <img className="logo" src={logo} alt="Logo de la empresa" />
            </header>
                <img src={logo} alt="Logo" className="logo" />
                <form onSubmit={handleLogin}>
                <h1>Iniciar Sesión</h1>
                <div className="input-container">
                    <input
                        type="text"
                        id="usuario"
                        className="datos"
                        placeholder=" "
                        value={usuario}
                        onChange={(e) => setUsuario(e.target.value)}
                        required
                    />
                    <label htmlFor="usuario" className="form__label">Usuario</label>
                </div>
                    <div className="input-container">
                    <input
                        type="password"
                        id="contrasena"
                        className="datos"
                        placeholder=" "
                        value={contrasena}
                        onChange={(e) => setContrasena(e.target.value)}
                        required
                    />
                    <label htmlFor="contrasena" className="form__label">Contraseña</label>
                    </div>
                    <button type="submit">Iniciar Sesión</button>
                    <a href="http://localhost/pagina_test/EscogerRegistro.php">Registrarse</a>
                    <a href="http://localhost/pagina_test/form_recuperar.php" target="_blank">Olvido su contraseña?</a>
                </form>
            </div>
    );
};

export default Login;
