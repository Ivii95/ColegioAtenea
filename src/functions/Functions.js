import { useLinkTo } from "@react-navigation/native";
import React from "react";
import { Alert } from "react-native";
import * as RootNavigation from "./RootNavigation.js";
import * as Notifications from 'expo-notifications';
import * as Permisions from 'expo-permissions';
import * as G from "../functions/GLOBALES";

const getToken = async () => {
  const {status} = await Permisions.getAsync(Permisions.NOTIFICATIONS);
  if( status !== "granted"){
    return;
  }
  const token = Notifications.getExpoPushTokenAsync();
  console.log(token);
  return token;
};

class Functions {
  
  loginAcepted = (username) =>
    Alert.alert(
      "Usuario y Contraseña",
      "Correcto",
      username,
      [
        {
          text: "Cancelar",
          onPress: () => console.log("Cancelar Pressed"),
          style: "cancel",
        },
        { text: "OK", onPress: () => console.log("OK Pressed") },
      ],
      { cancelable: true }
    );
  loginNoAcepted = () =>
    Alert.alert(
      "Usuario y Contraseña",
      "Incorrecto",
      [
        {
          text: "Cancelar",
          onPress: () => console.log("Cancelar Pressed"),
          style: "cancel",
        },
        { text: "OK", onPress: () => console.log("OK Pressed") },
      ],
      { cancelable: true }
    );
  login = (tipo) => {
    if (tipo == G.ALUMNO) {
      RootNavigation.navigate(G.ALUMNO);
    } else if (tipo == G.PADRES) {
      RootNavigation.navigate(G.PADRES);
    } else if (tipo == G.PROFESOR) {
      RootNavigation.navigate(G.PROFESOR);
    } else {
      this.loginNoAcepted(tipo);
    }
  };
  mandarLogin = (title) => {
    G.SELECCION = title;
    RootNavigation.navigate("Login");
  };
  mandarPrincipal = () => {
    RootNavigation.navigate(G.PRINCIPAL);
    //RootNavigation.navigate("Alumno1");
  };
}
export default new Functions();
