import React, { useEffect, useState } from "react";
import {
  View,
  Text,
  StyleSheet,
  Image,
  TouchableOpacity,
  ScrollView,
  StatusBar,
} from "react-native";
import { useNavigation } from "@react-navigation/native";
import { StackNavigationProp } from "@react-navigation/stack";
import { getAllJobs } from "../../Data/Repositories/JobRepository";
import { Job } from "../../Domain/models/job";
import { FontAwesome } from "@expo/vector-icons";

type RootStackParamList = {
  Home: undefined;
  Detalle: { id: number };
  Favoritos: undefined;
  User: undefined;
  Notificaciones: undefined; // ✅ añadida
};

export default function HomeScreen() {
  const navigation = useNavigation<StackNavigationProp<RootStackParamList, "Home">>();
  const [jobs, setJobs] = useState<Job[]>([]);

  useEffect(() => {
    fetchJobs();
  }, []);

  const fetchJobs = async () => {
    try {
      const data = await getAllJobs();
      setJobs(data);
    } catch (error) {
      console.error("❌ Error al obtener empleos:", error);
    }
  };

  return (
    <View style={styles.container}>
      <StatusBar barStyle="light-content" />
      <View style={styles.header}>
        <Image source={require("../../../assets/logo.png")} style={styles.logo} />
        <Text style={styles.headerTitle}>Empleos Disponibles</Text>

        {/* ✅ Campanita funcional */}
        <TouchableOpacity onPress={() => navigation.navigate("Notificaciones")}>
          <FontAwesome name="bell" size={24} color="#FFF" />
        </TouchableOpacity>
      </View>

      <ScrollView>
        <Image source={require("../../../assets/banner.jpg")} style={styles.banner} />
        <View style={styles.bannerTextContainer}>
          <Text style={styles.bannerText}>Encuentra tu empleo ideal hoy mismo. ¡Aplica ahora!</Text>
        </View>

        <Text style={styles.sectionTitle}>Últimos Empleos</Text>
        <View style={styles.jobsContainer}>
          {jobs.map((item) => {
            const imageUrl =
              item.oferta_empleocol && item.oferta_empleocol.trim() !== ""
                ? item.oferta_empleocol.startsWith("http")
                  ? item.oferta_empleocol.replace("192.168.101.1:5000", "192.168.101.12/pagina_test")
                  : `http://192.168.101.12/pagina_test/uploads/${encodeURIComponent(item.oferta_empleocol)}`
                : "https://via.placeholder.com/300";

            return (
              <TouchableOpacity
                key={item.id_oferta_empleo}
                style={styles.jobCard}
                onPress={() => navigation.navigate("Detalle", { id: item.id_oferta_empleo })}
              >
                <Image source={{ uri: imageUrl }} style={styles.jobImage} />
                <View style={styles.jobInfo}>
                  <Text style={styles.jobTitle}>{item.titulo_emp}</Text>
                  <Text numberOfLines={2} style={styles.jobDescription}>
                    {item.descripcion}
                  </Text>
                  <Text style={styles.jobLocation}>📍 {item.ubicacion}</Text>
                </View>
              </TouchableOpacity>
            );
          })}
        </View>
      </ScrollView>

      <View style={styles.bottomMenu}>
        <TouchableOpacity onPress={() => navigation.navigate("Home")} style={styles.menuItem}>
          <FontAwesome name="home" size={24} color="#4A148C" />
          <Text style={styles.menuText}>Inicio</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => navigation.navigate("Favoritos")} style={styles.menuItem}>
          <FontAwesome name="envelope" size={24} color="#4A148C" />
          <Text style={styles.menuText}>Mensajes</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => navigation.navigate("User")} style={styles.menuItem}>
          <FontAwesome name="user" size={24} color="#4A148C" />
          <Text style={styles.menuText}>Usuario</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: "#FFFFFF" },
  header: {
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "space-between",
    padding: 20,
    backgroundColor: "#4A148C",
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
  },
  logo: { width: 100, height: 100, resizeMode: "contain" },
  headerTitle: { fontSize: 24, fontWeight: "bold", color: "#FFF", marginLeft: 10 },
  banner: {
    width: "100%",
    height: 250,
    resizeMode: "cover",
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
  },
  bannerTextContainer: {
    paddingHorizontal: 15,
    paddingVertical: 10,
    backgroundColor: "#F1F1F1",
    marginBottom: 20,
  },
  bannerText: {
    fontSize: 18,
    color: "#4A148C",
    fontWeight: "bold",
    textAlign: "center",
  },
  sectionTitle: {
    fontSize: 24,
    fontWeight: "bold",
    color: "#4A148C",
    marginVertical: 20,
    textAlign: "center",
  },
  jobsContainer: { paddingHorizontal: 15 },
  jobCard: {
    backgroundColor: "white",
    borderRadius: 15,
    marginBottom: 15,
    shadowColor: "#000",
    shadowOpacity: 0.1,
    shadowRadius: 5,
    elevation: 3,
  },
  jobImage: {
    width: "100%",
    height: 180,
    borderTopLeftRadius: 15,
    borderTopRightRadius: 15,
  },
  jobInfo: { padding: 15 },
  jobTitle: { fontSize: 18, fontWeight: "bold", color: "#4A148C", marginBottom: 5 },
  jobDescription: { fontSize: 14, color: "#333", marginBottom: 5 },
  jobLocation: { fontSize: 14, color: "#666", fontStyle: "italic" },
  bottomMenu: {
    flexDirection: "row",
    justifyContent: "space-around",
    paddingVertical: 15,
    backgroundColor: "#FFF",
    borderTopWidth: 1,
    borderTopColor: "#ddd",
  },
  menuItem: { alignItems: "center" },
  menuText: { fontSize: 12, color: "#4A148C", marginTop: 5 },
});
