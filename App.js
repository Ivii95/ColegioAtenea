import * as React from "react";
import {
  NavigationContainer,
  useNavigation,
  useRoute,
} from "@react-navigation/native";
import { createStackNavigator } from "@react-navigation/stack";
import TIC from "./src/screen/TIC.screen";
import Seleccion from "./src/screen/SeleccionPrincipal";
import Login from "./src/screen/Login";
import Alumno from "./src/screen/Alumno";
import Padres from "./src/screen/Padres";
import Profesor from "./src/screen/Profesor";
import Alumno1 from "./src/AFuncionalidades/Alumnos/Screen/ZonaDeComunicacion.screen";
//import Alumno2 from './src/AFuncionalidades/Alumnos/Screen/SeguimientoEducativo.screen'
//import Alumno3 from './src/AFuncionalidades/Alumnos/Screen/HorariosDeClase.screen'
//import Alumno4 from './src/AFuncionalidades/Alumnos/Screen/Evaluaciones.screen'
import Data from "./src/screen/Data";
import { navigationRef } from "./src/functions/RootNavigation";
import { Text } from "react-native";
import * as G from "./src/functions/GLOBALES";

const Stack = createStackNavigator();
function AppNavigator() {
  return (
    //Aqui reside la navegacion principal.
    //Hacemos referencia a un archivo global para poder acceder a el
    //desde cualquier sitio del programa.
    <NavigationContainer
      ref={navigationRef}
      fallback={<Text>Cargando...</Text>}
      options={{
        headerMode: "none",
      }}
    >
      <Stack.Navigator
        //Este parametro indica la ruta principal en la que empezaria el programa.
        initialRouteName="TIC"
        //Esta opcion es para ocultar las rutas en la parte superior de la pantalla.
        screenOptions={{
          headerShown: false,
        }}
      >
        {
          //Esto son las principales "Screen" o pantallas a la que se accedera desde el programa.
        }
        <Stack.Screen name="TIC" component={TIC} />
        <Stack.Screen name={G.PRINCIPAL} component={Seleccion} />
        <Stack.Screen name="Login" component={Login} />
        <Stack.Screen name={G.ALUMNO} component={Alumno} />
        <Stack.Screen name={G.PADRES} component={Padres} />
        <Stack.Screen name={G.PROFESOR} component={Profesor} />
        <Stack.Screen name="Alumno1" component={Alumno1} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
export default AppNavigator;
