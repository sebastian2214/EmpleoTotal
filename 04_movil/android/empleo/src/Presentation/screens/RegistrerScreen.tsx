import React, { useState } from "react";
import { View, Text, TextInput, TouchableOpacity, ToastAndroid, StyleSheet } from "react-native";
import axios from "axios";
import bcrypt from "react-native-bcrypt"; // Usamos bcrypt para encriptar la contraseña

const RegisterScreen = ({ navigation }) => {
  const [usuario, setUsuario] = useState("");
  const [contrasena, setContrasena] = useState("");
  const [confirmContrasena, setConfirmContrasena] = useState("");
  const [email, setEmail] = useState("");

  const handleRegister = async () => {
    // Validar si las contraseñas coinciden
    if (contrasena !== confirmContrasena) {
      ToastAndroid.show("⚠️ Las contraseñas no coinciden", ToastAndroid.LONG);
      return;
    }

    // Encriptar la contraseña
    const salt = bcrypt.genSaltSync(10);
    const hashedPassword = bcrypt.hashSync(contrasena, salt);

    try {
      // Enviar datos al servidor
      const response = await axios.post("http://192.168.101.12:5000/register", {
        usuario,
        contrasena: hashedPassword,
        email,
      });

      if (response.data.success) {
        ToastAndroid.show("✅ Registro exitoso", ToastAndroid.LONG);
        navigation.navigate("LoginScreen"); // Redirigir al login
      } else {
        ToastAndroid.show(`⚠️ ${response.data.message}`, ToastAndroid.LONG);
      }
    } catch (error) {
      ToastAndroid.show("🚨 Error en el servidor. Verifica tu conexión.", ToastAndroid.LONG);
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Registrarse</Text>

      <TextInput
        style={styles.input}
        placeholder="Usuario"
        value={usuario}
        onChangeText={setUsuario}
      />
      <TextInput
        style={styles.input}
        placeholder="Correo electrónico"
        value={email}
        onChangeText={setEmail}
      />
      <TextInput
        style={styles.input}
        placeholder="Contraseña"
        secureTextEntry
        value={contrasena}
        onChangeText={setContrasena}
      />
      <TextInput
        style={styles.input}
        placeholder="Confirmar Contraseña"
        secureTextEntry
        value={confirmContrasena}
        onChangeText={setConfirmContrasena}
      />

      <TouchableOpacity style={styles.button} onPress={handleRegister}>
        <Text style={styles.buttonText}>Registrarse</Text>
      </TouchableOpacity>

      <TouchableOpacity onPress={() => navigation.navigate("LoginScreen")}>
        <Text style={styles.loginText}>¿Ya tienes cuenta? Inicia sesión</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#1a0739",
    justifyContent: "center",
    paddingHorizontal: 20,
  },
  title: {
    fontSize: 24,
    color: "#FFF",
    textAlign: "center",
    marginBottom: 20,
  },
  input: {
    backgroundColor: "#4b2173",
    color: "#FFF",
    borderRadius: 8,
    padding: 15,
    marginBottom: 15,
    fontSize: 16,
  },
  button: {
    backgroundColor: "#8E44AD",
    paddingVertical: 12,
    borderRadius: 8,
    alignItems: "center",
  },
  buttonText: {
    color: "#FFF",
    fontWeight: "bold",
    fontSize: 16,
  },
  loginText: {
    color: "#F48FB1",
    marginTop: 20,
    textAlign: "center",
  },
});

export default RegisterScreen;
