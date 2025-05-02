import React, { useEffect } from 'react';
import { View, Text, StyleSheet, Image, StatusBar, TouchableOpacity } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';

export default function EmpresaScreen() {
  const navigation = useNavigation();

  useEffect(() => {
    const checkRol = async () => {
      const rol = await AsyncStorage.getItem('userRol');
      if (rol !== '2') {
        navigation.reset({
          index: 0,
          routes: [{ name: 'LoginScreen' }],
        });
      }
    };
    checkRol();
  }, []);

  return (
    <View style={styles.container}>
      <StatusBar barStyle="light-content" />
      <View style={styles.header}>
        <Image source={require('../../../assets/logo.png')} style={styles.logo} />
        <Text style={styles.headerText}>Panel de Empresa</Text>
      </View>
      <View style={styles.content}>
        <Text style={styles.text}>Bienvenido a tu panel de empresa 👔</Text>
        <Text style={styles.text}>Aquí podrás publicar y administrar tus ofertas de empleo.</Text>

        <TouchableOpacity
          style={styles.publishButton}
          onPress={() => navigation.navigate('PublicarEmpleo')}
        >
          <Text style={styles.buttonText}>📢 Publicar Empleo</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#f3f0f7' },
  header: {
    backgroundColor: '#4A148C',
    paddingTop: 60,
    paddingBottom: 30,
    alignItems: 'center',
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
  },
  logo: { width: 100, height: 100, resizeMode: 'contain' },
  headerText: { color: '#FFF', fontSize: 22, fontWeight: 'bold', marginTop: 10 },
  content: { padding: 20, alignItems: 'center' },
  text: { fontSize: 16, color: '#333', marginVertical: 10, textAlign: 'center' },
  publishButton: {
    marginTop: 30,
    backgroundColor: '#6a1b9a',
    paddingVertical: 15,
    paddingHorizontal: 30,
    borderRadius: 20,
    elevation: 5,
  },
  buttonText: { color: '#fff', fontWeight: 'bold', fontSize: 16 },
});
