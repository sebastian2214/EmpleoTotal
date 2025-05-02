import React, { useEffect, useState } from "react";
import {
  View,
  Text,
  StyleSheet,
  Image,
  ScrollView,
  ActivityIndicator,
  TouchableOpacity,
  StatusBar,
  ToastAndroid,
} from "react-native";
import { useNavigation } from "@react-navigation/native";
import { StackNavigationProp } from "@react-navigation/stack";
import { getUserProfile } from "../../Data/Repositories/JobRepository";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { FontAwesome } from "@expo/vector-icons";

type RootStackParamList = {
  Home: undefined;
  Favoritos: undefined;
  User: undefined;
  LoginScreen: undefined;
};

export default function ProfileScreen() {
  const navigation = useNavigation<StackNavigationProp<RootStackParamList>>();
  const [user, setUser] = useState<any>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchUserProfile();
  }, []);

  const fetchUserProfile = async () => {
    try {
      const data = await getUserProfile();
      setUser(data);
    } catch (error) {
      console.error("❌ Error al obtener perfil:", error);
    } finally {
      setLoading(false);
    }
  };

  const logout = async () => {
    await AsyncStorage.removeItem("userToken");
    await AsyncStorage.removeItem("userRol");
    ToastAndroid.show("👋 Sesión cerrada", ToastAndroid.SHORT);
    navigation.replace("LoginScreen");
  };

  if (loading) {
    return (
      <View style={styles.loadingContainer}>
        <ActivityIndicator size="large" color="#4A148C" />
      </View>
    );
  }

  if (!user) {
    return (
      <View style={styles.container}>
        <StatusBar barStyle="light-content" />
        <View style={styles.header}>
          <Image source={require("../../../assets/logo.png")} style={styles.logo} />
          <Text style={styles.headerTitle}>Perfil de Usuario</Text>
          <FontAwesome name="user" size={24} color="#FFF" />
        </View>

        <View style={styles.noSessionContainer}>
          <Text style={styles.notLoggedText}>No has iniciado sesión</Text>
          <TouchableOpacity
            style={styles.loginButton}
            onPress={() => navigation.navigate("LoginScreen")}
          >
            <Text style={styles.loginButtonText}>Iniciar sesión</Text>
          </TouchableOpacity>
        </View>

        <View style={styles.bottomMenu}>
          <TouchableOpacity onPress={() => navigation.navigate("Home")} style={styles.menuItem}>
            <FontAwesome name="home" size={24} color="#4A148C" />
            <Text style={styles.menuText}>Inicio</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={() => navigation.navigate("Favoritos")} style={styles.menuItem}>
            <FontAwesome name="heart" size={24} color="#4A148C" />
            <Text style={styles.menuText}>Favoritos</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={() => navigation.navigate("User")} style={styles.menuItem}>
            <FontAwesome name="user" size={24} color="#4A148C" />
            <Text style={styles.menuText}>Perfil</Text>
          </TouchableOpacity>
        </View>
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <StatusBar barStyle="light-content" />
      <View style={styles.header}>
        <Image source={require("../../../assets/logo.png")} style={styles.logo} />
        <Text style={styles.headerTitle}>Mi Perfil</Text>
        <FontAwesome name="user" size={24} color="#FFF" />
      </View>

      <ScrollView style={{ flex: 1 }}>
        <View style={styles.profileHeader}>
          <Image
            source={{ uri: user.foto_perfil || "https://via.placeholder.com/150" }}
            style={styles.profileImage}
          />
          <Text style={styles.userName}>{user.nombre} {user.apellido}</Text>
          <Text style={styles.userEmail}>{user.correo}</Text>
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Hoja de Vida</Text>
          <Text style={styles.description}>{user.descripcion_sobre_ti || "No disponible"}</Text>
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Estudios</Text>
          {user.estudios.length > 0 ? (
            user.estudios.map((estudio: any) => (
              <View key={estudio.idEstudios} style={styles.card}>
                <Text style={styles.cardTitle}>{estudio.titulo}</Text>
                <Text>{estudio.institucion}</Text>
                <Text>{estudio.fecha_inicio} - {estudio.fecha_fin}</Text>
              </View>
            ))
          ) : (
            <Text style={styles.noDataText}>No hay estudios registrados</Text>
          )}
        </View>

        {/* Botón de cerrar sesión */}
        <View style={{ alignItems: "center", marginBottom: 30 }}>
          <TouchableOpacity style={styles.logoutButton} onPress={logout}>
            <Text style={styles.logoutText}>Cerrar sesión</Text>
          </TouchableOpacity>
        </View>
      </ScrollView>

      <View style={styles.bottomMenu}>
        <TouchableOpacity onPress={() => navigation.navigate("Home")} style={styles.menuItem}>
          <FontAwesome name="home" size={24} color="#4A148C" />
          <Text style={styles.menuText}>Inicio</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => navigation.navigate("Favoritos")} style={styles.menuItem}>
          <FontAwesome name="heart" size={24} color="#4A148C" />
          <Text style={styles.menuText}>Favoritos</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => navigation.navigate("User")} style={styles.menuItem}>
          <FontAwesome name="user" size={24} color="#4A148C" />
          <Text style={styles.menuText}>Perfil</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: "#FFF" },
  header: {
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "space-between",
    padding: 10,
    backgroundColor: "#4A148C",
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
  },
  logo: { width: 100, height: 100, resizeMode: "contain" },
  headerTitle: { fontSize: 22, fontWeight: "bold", color: "#FFF" },

  profileHeader: { alignItems: "center", marginTop: 20, marginBottom: 10 },
  profileImage: { width: 120, height: 120, borderRadius: 60, marginBottom: 10 },
  userName: { fontSize: 22, fontWeight: "bold", color: "#4A148C" },
  userEmail: { fontSize: 16, color: "#666" },

  section: { marginBottom: 20, paddingHorizontal: 20 },
  sectionTitle: { fontSize: 20, fontWeight: "bold", color: "#4A148C", marginBottom: 10 },
  description: { fontSize: 16, color: "#333" },
  card: {
    backgroundColor: "#F5F5F5",
    padding: 15,
    borderRadius: 10,
    marginBottom: 10,
  },
  cardTitle: { fontSize: 18, fontWeight: "bold", color: "#4A148C" },
  noDataText: { fontSize: 16, color: "#666", fontStyle: "italic" },

  loadingContainer: { flex: 1, justifyContent: "center", alignItems: "center" },
  notLoggedText: { fontSize: 18, textAlign: "center", color: "#4A148C", marginBottom: 20 },
  loginButton: {
    backgroundColor: "#4A148C",
    padding: 12,
    borderRadius: 10,
    alignSelf: "center",
  },
  loginButtonText: { color: "#FFF", fontWeight: "bold" },
  noSessionContainer: { justifyContent: "center", alignItems: "center", flex: 1 },

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

  logoutButton: {
    backgroundColor: "#E53935",
    paddingVertical: 10,
    paddingHorizontal: 25,
    borderRadius: 8,
  },
  logoutText: {
    color: "#FFF",
    fontWeight: "bold",
    fontSize: 16,
  },
});
