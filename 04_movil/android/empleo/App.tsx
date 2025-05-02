import React from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createStackNavigator } from "@react-navigation/stack";
import HomeScreen from "./src/Presentation/screens/HomeScreen";
import DetalleScreen from "./src/Presentation/screens/DetalleScreen";
import UserScreen from "./src/Presentation/screens/ProfileScreen";
import LoginScreen from "./src/Presentation/screens/LoginScreen";
import RegistrerScreen from "./src/Presentation/screens/RegistrerScreen"; 
import EmpresaScreen from "./src/Presentation/screens/EmpresaScreen"; 
import PublicarEmpleo from "./src/Presentation/screens/PublicarEmpleo"; 
import NotificacionesScreen from "./src/Presentation/screens/NotificacionesScreen"; 


const Stack = createStackNavigator();

export default function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator
        screenOptions={{
          headerStyle: { backgroundColor: "#8E44AD" },
          headerTintColor: "#FFF",
        }}
      >
        <Stack.Screen
          name="Home"
          component={HomeScreen}
          options={{ headerShown: false }}
        />
        <Stack.Screen
          name="Detalle"
          component={DetalleScreen}
          options={{ headerShown: false }}
        />
        <Stack.Screen
          name="User"
          component={UserScreen}
          options={{ headerShown: false }}
        />
        <Stack.Screen
          name="LoginScreen" // ✅ Añadido correctamente aquí
          component={LoginScreen}
          options={{ headerShown: false }}
        />  
        <Stack.Screen
        name="Registrer"
        component={RegistrerScreen}
        options={{ headerShown: false }}
      />
        <Stack.Screen
        name="Empresa"
        component={EmpresaScreen}
        options={{ headerShown: false }}
      />
           <Stack.Screen
        name="PublicarEmpleo"
        component={PublicarEmpleo}
        options={{ headerShown: false }}
      />
         <Stack.Screen
        name="Notificaciones"
        component={NotificacionesScreen}
        options={{ headerShown: false }}
      />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
