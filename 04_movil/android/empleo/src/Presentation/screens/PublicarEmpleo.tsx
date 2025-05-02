import React, { useEffect, useState } from 'react';
import {
  View, Text, TextInput, StyleSheet, Button, Image,
  TouchableOpacity, ScrollView, ToastAndroid
} from 'react-native';
import axios from 'axios';
import * as ImagePicker from 'expo-image-picker';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { Picker } from '@react-native-picker/picker';


export default function PublicarEmpleoScreen({ navigation }) {
  const [form, setForm] = useState({
    titulo_emp: '',
    descripcion: '',
    requisitos: '',
    ubicacion: '',
    salario: '',
    telefono: '',
    correo: '',
    link_test: '',
    sub_cat_id_sub_cat: ''
  });
  const [imagen, setImagen] = useState<any>(null);
  const [subcategorias, setSubcategorias] = useState([]);

  useEffect(() => {
    axios.get("http://192.168.101.12:5000/subcategorias")
      .then(res => setSubcategorias(res.data))
      .catch(() => ToastAndroid.show("❌ Error al cargar subcategorías", ToastAndroid.LONG));
  }, []);

  const seleccionarImagen = async () => {
    const result = await ImagePicker.launchImageLibraryAsync({ mediaTypes: ImagePicker.MediaTypeOptions.Images, allowsEditing: true });
    if (!result.canceled) setImagen(result.assets[0]);
  };

  const handleSubmit = async () => {
    const token = await AsyncStorage.getItem("userToken");
    const data = new FormData();

    Object.entries(form).forEach(([key, value]) => data.append(key, value));
    if (imagen) {
      data.append("oferta_empleocol", {
        uri: imagen.uri,
        name: "empleo.jpg",
        type: "image/jpeg",
      } as any);
    }

    try {
      const res = await axios.post("http://192.168.101.12:5000/publicar_empleo", data, {
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: `Bearer ${token}`,
        },
      });

      if (res.data.success) {
        ToastAndroid.show("✅ Empleo publicado", ToastAndroid.LONG);
        navigation.goBack();
      }
    } catch (err) {
      console.log("❌ Error al publicar:", err);
      ToastAndroid.show("❌ Error al publicar", ToastAndroid.LONG);
    }
  };

  return (
    <ScrollView contentContainerStyle={styles.container}>
      <Text style={styles.title}>📝 Publicar Empleo</Text>

      {["titulo_emp", "descripcion", "requisitos", "ubicacion", "salario", "telefono", "correo", "link_test"].map(key => (
        <TextInput
          key={key}
          placeholder={key.replace("_", " ")}
          style={styles.input}
          placeholderTextColor="#ccc"
          onChangeText={text => setForm(prev => ({ ...prev, [key]: text }))}
        />
      ))}

      <Picker
        selectedValue={form.sub_cat_id_sub_cat}
        onValueChange={value => setForm(prev => ({ ...prev, sub_cat_id_sub_cat: value }))}
        style={styles.picker}
      >
        <Picker.Item label="Selecciona subcategoría" value="" />
        {subcategorias.map(sub => (
          <Picker.Item label={sub.nombre_sub_cat} value={sub.id_sub_cat} key={sub.id_sub_cat} />
        ))}
      </Picker>

      {imagen && <Image source={{ uri: imagen.uri }} style={styles.preview} />}
      <TouchableOpacity onPress={seleccionarImagen} style={styles.imageBtn}>
        <Text style={styles.imageBtnText}>📷 Seleccionar Imagen (opcional)</Text>
      </TouchableOpacity>

      <Button title="📤 Publicar Empleo" onPress={handleSubmit} color="#6a1b9a" />
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { padding: 20, backgroundColor: "#fff", flexGrow: 1 },
  title: { fontSize: 22, fontWeight: "bold", marginBottom: 20, color: "#4A148C" },
  input: {
    borderWidth: 1, borderColor: "#ccc", borderRadius: 10,
    padding: 10, marginBottom: 15, color: "#000"
  },
  picker: {
    borderWidth: 1, borderColor: "#ccc", borderRadius: 10,
    paddingHorizontal: 10, marginBottom: 15
  },
  imageBtn: {
    backgroundColor: "#eee", padding: 10, marginBottom: 15, borderRadius: 10,
    alignItems: "center"
  },
  imageBtnText: { color: "#333", fontWeight: "bold" },
  preview: { width: "100%", height: 200, borderRadius: 10, marginBottom: 15 }
});
