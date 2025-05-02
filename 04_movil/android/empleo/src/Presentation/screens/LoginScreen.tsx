import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  StyleSheet,
  Image,
  TextInput,
  TouchableOpacity,
  ToastAndroid,
} from 'react-native';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { NativeStackScreenProps } from '@react-navigation/native-stack';

type Props = NativeStackScreenProps<any>;

export default function LoginScreen({ navigation }: Props) {
  const [usuario, setUsuario] = useState('');
  const [contrasena, setContrasena] = useState('');
  useEffect(() => {
    const checkLoginStatus = async () => {
      const token = await AsyncStorage.getItem('userToken');
      const rol = await AsyncStorage.getItem('userRol');
  
      // 🔐 Solo redirigir si ambas existen Y estás seguro de que el token sigue válido
      if (token && rol) {
        // Puedes validar el token aquí si tu backend tiene endpoint de validación
        console.log("Token encontrado, esperando login manual...");
      }
    };
    checkLoginStatus();
  }, []);
  

  const handleLogin = async () => {
    try {
      const response = await axios.post('http://192.168.101.12:5000/login', {
        usuario,
        contrasena,
      });

      if (response.data.success) {
        await AsyncStorage.setItem('userToken', response.data.token);
        await AsyncStorage.setItem('userRol', response.data.rol_id_rol.toString());

        ToastAndroid.show('✅ Inicio de sesión exitoso', ToastAndroid.LONG);

        switch (response.data.rol_id_rol) {
          case 2:
            navigation.replace('Empresa');
            break;
          case 3:
            navigation.replace('User');
            break;
          default:
            ToastAndroid.show('⚠️ Rol no reconocido', ToastAndroid.LONG);
        }
      } else {
        ToastAndroid.show(`⚠️ ${response.data.message}`, ToastAndroid.LONG);
      }
    } catch (error) {
      console.log("❌ Error en login:", error);
      ToastAndroid.show('🚨 Error en el servidor. Verifica tu conexión.', ToastAndroid.LONG);
    }
  };

  return (
    <View style={styles.container}>
      <View style={styles.logoContainer}>
        <Image source={require('../../../assets/logo.png')} style={styles.logoImage} />
        <Text style={styles.logoText}>EmpleoTotal</Text>
      </View>
      <View style={styles.form}>
        <Text style={styles.formText}>INGRESAR</Text>
        <View style={styles.formInput}>
          <TextInput
            style={styles.formTextInput}
            placeholder="Usuario"
            placeholderTextColor="#ccc"
            value={usuario}
            onChangeText={setUsuario}
          />
        </View>
        <View style={styles.formInput}>
          <TextInput
            style={styles.formTextInput}
            placeholder="Contraseña"
            placeholderTextColor="#ccc"
            secureTextEntry
            value={contrasena}
            onChangeText={setContrasena}
          />
        </View>
        <TouchableOpacity style={styles.buttonContainer} onPress={handleLogin}>
          <Text style={styles.buttonText}>ENTRAR</Text>
        </TouchableOpacity>
        <View style={styles.formRegister}>
          <Text style={{ color: 'white' }}>¿No tienes cuenta?</Text>
          <TouchableOpacity onPress={() => navigation.navigate('RegisterScreen')}>
            <Text style={styles.formRegisterText}>Regístrate</Text>
          </TouchableOpacity>
        </View>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#1a0739' },
  logoContainer: {
    position: 'absolute',
    alignSelf: 'center',
    top: '35%',
    alignItems: 'center',
    backgroundColor: '#3e1b6a',
    padding: 20,
    borderRadius: 100,
    elevation: 5,
  },
  logoImage: { width: 120, height: 120, borderRadius: 60 },
  logoText: { color: 'white', fontSize: 22, marginTop: 10, fontWeight: 'bold' },
  form: {
    width: '100%',
    height: '45%',
    backgroundColor: '#2a0d50',
    position: 'absolute',
    bottom: 0,
    borderTopLeftRadius: 40,
    borderTopRightRadius: 40,
    padding: 30,
    alignItems: 'center',
  },
  formText: { fontWeight: 'bold', fontSize: 18, color: 'white', marginBottom: 20 },
  formInput: {
    flexDirection: 'row',
    backgroundColor: '#4b2173',
    borderRadius: 10,
    paddingHorizontal: 15,
    alignItems: 'center',
    marginBottom: 15,
    width: '90%',
  },
  formTextInput: { flex: 1, color: 'white', paddingVertical: 10, fontSize: 16 },
  formRegister: { flexDirection: 'row', justifyContent: 'center', marginTop: 20 },
  formRegisterText: {
    fontStyle: 'italic',
    color: '#f48fb1',
    fontWeight: 'bold',
    marginLeft: 5,
  },
  buttonContainer: {
    marginTop: 20,
    backgroundColor: '#6a1b9a',
    paddingVertical: 12,
    paddingHorizontal: 60,
    borderRadius: 25,
    elevation: 5,
  },
  buttonText: { color: 'white', fontWeight: 'bold', fontSize: 16, textAlign: 'center' },
});
