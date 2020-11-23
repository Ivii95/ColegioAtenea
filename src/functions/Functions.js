import { useLinkTo } from '@react-navigation/native';
import React from 'react'
import { Alert } from "react-native"
import * as RootNavigation from './RootNavigation.js';
import * as G from '../functions/GLOBALES'

class Functions {

    loginAcepted = (username) =>
        Alert.alert(
            "Usuario y Contraseña",
            "Correcto", username,
            [
                {
                    text: "Cancelar",
                    onPress: () => console.log("Cancelar Pressed"),
                    style: "cancel"
                },
                { text: "OK", onPress: () => console.log("OK Pressed") }
            ],
            { cancelable: false }
        );
    loginNoAcepted = () =>
        Alert.alert(
            "Usuario y Contraseña",
            "Incorrecto",
            [
                {
                    text: "Cancelar",
                    onPress: () => console.log("Cancelar Pressed"),
                    style: "cancel"
                },
                { text: "OK", onPress: () => console.log("OK Pressed") }
            ],
            { cancelable: false }
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
    }
}
export default new Functions()