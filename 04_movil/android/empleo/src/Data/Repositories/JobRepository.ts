// JobRepository.ts
import axios from "axios";
import AsyncStorage from "@react-native-async-storage/async-storage";

const API_URL = "http://192.168.101.12:5000";

// Empleos
export async function getAllJobs() {
  try {
    const res = await axios.get(`${API_URL}/empleos`);
    return res.data;
  } catch (err) {
    console.error("❌ Error al obtener empleos:", err);
    throw err;
  }
}

// Empleo por ID
export async function getJobById(id: number) {
  try {
    const res = await axios.get(`${API_URL}/empleos/${id}`);
    return res.data;
  } catch (err) {
    console.error("❌ Error al obtener empleo:", err);
    throw err;
  }
}

// Perfil
export async function getUserProfile() {
  try {
    const token = await AsyncStorage.getItem("userToken");
    const res = await axios.get(`${API_URL}/perfil_usuario`, {
      headers: { Authorization: `Bearer ${token}` },
    });
    return res.data;
  } catch (err) {
    console.error("❌ Error al obtener perfil:", err);
    return null;
  }
}
