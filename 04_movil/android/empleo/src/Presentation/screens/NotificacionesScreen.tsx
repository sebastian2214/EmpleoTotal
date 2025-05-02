import React, { useEffect, useState } from "react";
import {
  View,
  Text,
  FlatList,
  StyleSheet,
  ActivityIndicator,
  StatusBar,
  TouchableOpacity,
  ToastAndroid,
} from "react-native";
import axios from "axios";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { FontAwesome } from "@expo/vector-icons";
import { useNavigation } from "@react-navigation/native";

type Notificacion = {
  idnotificaciones: number;
  contenido: string;
  fecha_envio: string;
  titulo_emp?: string;
};

export default function NotificacionesScreen() {
  const [notificaciones, setNotificaciones] = useState<Notificacion[]>([]);
  const [loading, setLoading] = useState(true);
  const navigation = useNavigation();

  useEffect(() => {
    obtenerNotificaciones();
  }, []);

  const obtenerNotificaciones = async () => {
    try {
      const token = await AsyncStorage.getItem("userToken");
  
      if (!token) {
        console.log("⚠️ No hay token en almacenamiento");
        return;
      }
  
      const res = await axios.get("http://192.168.101.12:5000/notificaciones", {
        headers: { Authorization: `Bearer ${token}` },
      });
  
      if (res.data.success && res.data.notificaciones.length > 0) {
        setNotificaciones(res.data.notificaciones);
      } else {
        setNotificaciones([]); // No hay notis, pero no es error
      }
  
    } catch (err) {
      console.error("❌ Error al obtener notificaciones:", err);
    } finally {
      setLoading(false);
    }
  };
  

  const renderItem = ({ item }: { item: Notificacion }) => (
    <View style={styles.card}>
      <Text style={styles.text}>{item.contenido}</Text>
      {item.titulo_emp && (
        <Text style={styles.subtext}>Oferta: {item.titulo_emp}</Text>
      )}
      <Text style={styles.date}>📅 {item.fecha_envio}</Text>
    </View>
  );

  return (
    <View style={styles.container}>
      <StatusBar barStyle="light-content" />
      <View style={styles.header}>
        <TouchableOpacity onPress={() => navigation.goBack()}>
          <FontAwesome name="arrow-left" size={24} color="#FFF" />
        </TouchableOpacity>
        <Text style={styles.headerTitle}>Notificaciones</Text>
        <View style={{ width: 24 }} />
      </View>

      {loading ? (
        <ActivityIndicator size="large" color="#4A148C" style={{ marginTop: 40 }} />
      ) : notificaciones.length === 0 ? (
        <View style={styles.noNotiContainer}>
          <Text style={styles.noNotiText}>📭 No tienes notificaciones</Text>
        </View>
      ) : (
        <FlatList
          data={notificaciones}
          renderItem={renderItem}
          keyExtractor={(item) => item.idnotificaciones.toString()}
          contentContainerStyle={{ padding: 20 }}
        />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: "#f9f8fd" },
  header: {
    backgroundColor: "#4A148C",
    paddingTop: 60,
    paddingBottom: 25,
    paddingHorizontal: 20,
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
  },
  headerTitle: { color: "#FFF", fontSize: 22, fontWeight: "bold" },
  card: {
    backgroundColor: "#FFF",
    padding: 15,
    marginBottom: 15,
    borderRadius: 10,
    shadowColor: "#000",
    shadowOpacity: 0.05,
    shadowRadius: 5,
    elevation: 2,
  },
  text: { fontSize: 16, color: "#333", marginBottom: 5 },
  subtext: { fontSize: 15, color: "#5E2D79", marginBottom: 5 },
  date: { fontSize: 14, color: "#666" },
  noNotiContainer: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    marginTop: 50,
  },
  noNotiText: {
    fontSize: 18,
    fontStyle: "italic",
    color: "#999",
  },
});
