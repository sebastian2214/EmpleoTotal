import React, { useEffect, useState } from "react";
import { View, Text, StyleSheet, FlatList, ActivityIndicator, TouchableOpacity } from "react-native";
import { getAllJobs } from "../../Data/Repositories/JobRepository";
import { Job } from "../../Domain/models/job";
import { useNavigation } from "@react-navigation/native";
import { StackNavigationProp } from "@react-navigation/stack";

// 📌 Definir las rutas para la navegación
type RootStackParamList = {
  Home: undefined;
  Detalle: { id: number };
};

type NavigationProp = StackNavigationProp<RootStackParamList, "Home">;

export default function HomeScreen() {
  const [jobs, setJobs] = useState<Job[]>([]);
  const [loading, setLoading] = useState(true);
  const navigation = useNavigation<NavigationProp>(); // 👈 Esto soluciona el error

  useEffect(() => {
    fetchJobs();
  }, []);

  const fetchJobs = async () => {
    try {
      console.log("⌛ Obteniendo empleos...");
      const data = await getAllJobs();
      setJobs(data);
    } catch (error) {
      console.error("❌ Error al obtener empleos:", error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) {
    return (
      <View style={styles.centered}>
        <ActivityIndicator size="large" color="purple" />
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Lista de Empleos</Text>

      {jobs.length === 0 ? (
        <Text style={styles.noJobsText}>No hay empleos disponibles.</Text>
      ) : (
        <FlatList
          data={jobs}
          keyExtractor={(item) => item.id_oferta_empleo.toString()}
          renderItem={({ item }) => (
            <View style={styles.jobCard}>
              <Text style={styles.jobTitle}>{item.titulo_emp}</Text>
              <Text>Descripción: {item.descripcion}</Text>
              <Text>Ubicación: {item.ubicacion}</Text>
              <Text>Salario: {item.salario}</Text>

              {/* 📌 Botón "Ver más" que navega a DetalleScreen.tsx */}
              <TouchableOpacity
                style={styles.button}
                onPress={() => navigation.navigate("Detalle", { id: item.id_oferta_empleo })}
              >
                <Text style={styles.buttonText}>Ver más</Text>
              </TouchableOpacity>
            </View>
          )}
        />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, padding: 20, backgroundColor: "white" },
  title: { fontSize: 20, fontWeight: "bold", marginBottom: 10 },
  jobCard: { padding: 15, backgroundColor: "#E1BEE7", marginBottom: 10, borderRadius: 10 },
  jobTitle: { fontSize: 16, fontWeight: "bold", color: "#6A0DAD" },
  button: { marginTop: 10, padding: 10, backgroundColor: "#6A0DAD", borderRadius: 5, alignItems: "center" },
  buttonText: { color: "white", fontWeight: "bold" },
  centered: { flex: 1, justifyContent: "center", alignItems: "center" },
  noJobsText: { fontSize: 16, textAlign: "center", marginTop: 20, color: "#6A0DAD" },
});
