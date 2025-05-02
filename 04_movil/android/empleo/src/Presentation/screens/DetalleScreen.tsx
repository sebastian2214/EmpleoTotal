import React, { useEffect, useState } from "react";
import {
  View,
  Text,
  StyleSheet,
  ActivityIndicator,
  Image,
  ScrollView,
  TouchableOpacity,
  Alert,
  StatusBar,
} from "react-native";
import { RouteProp, useRoute, useNavigation } from "@react-navigation/native";
import { StackNavigationProp } from "@react-navigation/stack";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { getJobById } from "../../Data/Repositories/JobRepository";
import { Job } from "../../Domain/models/job";
import { FontAwesome } from "@expo/vector-icons";
import axios from "axios";

type RootStackParamList = {
  Detalle: { id: number };
  Home: undefined;
};

export default function DetalleScreen() {
  const route = useRoute<RouteProp<RootStackParamList, "Detalle">>();
  const navigation = useNavigation<StackNavigationProp<RootStackParamList>>();
  const { id } = route.params;

  const [job, setJob] = useState<Job | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchJob();
  }, []);

  const fetchJob = async () => {
    try {
      const data = await getJobById(id);
      setJob(data);
    } catch (error) {
      console.error("❌ Error al obtener empleo:", error);
    } finally {
      setLoading(false);
    }
  };

  const aplicarEmpleo = async () => {
    const token = await AsyncStorage.getItem("userToken");
    if (!token) {
      Alert.alert("⚠️ Acción no permitida", "Debes iniciar sesión para aplicar");
      return;
    }

    try {
      const res = await axios.post(
        "http://192.168.101.12:5000/aplicar",
        { id_oferta_empleo: job?.id_oferta_empleo },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      if (res.data.success) {
        Alert.alert("✅ Aplicación exitosa", "Has aplicado correctamente");
      } else {
        Alert.alert("⚠️ Ya aplicaste", res.data.message);
      }
    } catch (err) {
      console.error("❌ Error al aplicar:", err);
      Alert.alert("🚫 Error", "No se pudo aplicar a la oferta");
    }
  };

  const handleBack = () => {
    navigation.navigate("Home");
  };

  if (loading) {
    return (
      <View style={styles.centered}>
        <ActivityIndicator size="large" color="purple" />
      </View>
    );
  }

  if (!job) {
    return (
      <View style={styles.centered}>
        <Text style={styles.errorText}>Error: No se encontró el empleo.</Text>
      </View>
    );
  }

  const imageUrl =
    job.oferta_empleocol?.startsWith("http")
      ? job.oferta_empleocol.replace("192.168.101.1:5000", "192.168.101.12/pagina_test")
      : `http://192.168.101.12/pagina_test/uploads/${job.oferta_empleocol}`;

  return (
    <View style={styles.container}>
      <StatusBar barStyle="light-content" />
      <View style={styles.header}>
        <TouchableOpacity onPress={handleBack}>
          <FontAwesome name="arrow-left" size={24} color="#FFF" />
        </TouchableOpacity>
        <Text style={styles.headerTitle}>Detalle del Empleo</Text>
        <View style={{ width: 24 }} />
      </View>

      <ScrollView style={{ padding: 20 }}>
        <Image source={{ uri: imageUrl }} style={styles.jobImage} />
        <Text style={styles.title}>{job.titulo_emp}</Text>
        <Text style={styles.subtitle}>Empresa ID: {job.empresas_id}</Text>

        <View style={styles.card}>
          <Text style={styles.cardTitle}>Descripción</Text>
          <Text style={styles.cardText}>{job.descripcion}</Text>
        </View>

        <View style={styles.card}>
          <Text style={styles.cardTitle}>Requisitos</Text>
          <Text style={styles.cardText}>{job.requisitos}</Text>
        </View>

        <View style={styles.card}>
          <Text style={styles.cardTitle}>Ubicación</Text>
          <Text style={styles.cardText}>{job.ubicacion}</Text>
        </View>

        <View style={styles.card}>
          <Text style={styles.cardTitle}>Salario</Text>
          <Text style={styles.cardText}>${job.salario}</Text>
        </View>

        <View style={styles.card}>
          <Text style={styles.cardTitle}>Contacto</Text>
          <Text style={styles.cardText}>📧 {job.correo}</Text>
          <Text style={styles.cardText}>📞 {job.telefono}</Text>
          {job.link_test && (
            <Text style={styles.cardText}>
              🌐 <Text style={styles.link}>{job.link_test}</Text>
            </Text>
          )}
        </View>

        <View style={styles.buttonContainer}>
          <TouchableOpacity
            style={styles.button}
            onPress={aplicarEmpleo}
          >
            <Text style={styles.buttonText}>Aplicar</Text>
          </TouchableOpacity>

          <TouchableOpacity
            style={[styles.button, { backgroundColor: "#6A1B9A" }]}
            onPress={() => Alert.alert("Simulación", "Realizar test")}
          >
            <Text style={styles.buttonText}>Realizar Test</Text>
          </TouchableOpacity>
        </View>
      </ScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: "#FAFAFA" },
  centered: { flex: 1, justifyContent: "center", alignItems: "center" },
  jobImage: { width: "100%", height: 220, borderRadius: 10, marginBottom: 20 },
  title: { fontSize: 26, fontWeight: "bold", color: "#5E2D79", textAlign: "center", marginBottom: 5 },
  subtitle: { fontSize: 18, color: "#333", textAlign: "center", marginBottom: 20 },
  card: { backgroundColor: "#FFFFFF", padding: 20, borderRadius: 10, marginBottom: 15, shadowColor: "#000", shadowOpacity: 0.1, shadowRadius: 5, elevation: 3 },
  cardTitle: { fontSize: 18, fontWeight: "bold", color: "#5E2D79", marginBottom: 5 },
  cardText: { fontSize: 16, color: "#333" },
  errorText: { fontSize: 18, color: "red" },
  link: { color: "#5E2D79", textDecorationLine: "underline" },
  header: { flexDirection: "row", alignItems: "center", justifyContent: "space-between", backgroundColor: "#4A148C", paddingVertical: 20, paddingHorizontal: 20, borderBottomLeftRadius: 20, borderBottomRightRadius: 20 },
  headerTitle: { fontSize: 20, fontWeight: "bold", color: "#FFF" },
  buttonContainer: { flexDirection: "row", justifyContent: "space-around", marginTop: 20 },
  button: {
    backgroundColor: "#8E24AA",
    paddingVertical: 12,
    paddingHorizontal: 25,
    borderRadius: 8,
    elevation: 2,
  },
  buttonText: { color: "#FFF", fontWeight: "bold", fontSize: 16 },
});
