import axios from "axios";

const API_URL = "http://localhost:5000"; // Si usas un emulador físico, cambia por tu IP

export const api = axios.create({
  baseURL: API_URL,
  headers: {
    "Content-Type": "application/json",
  },
});
