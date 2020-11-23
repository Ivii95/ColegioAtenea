import React from 'react'
import { } from "react-native"



//Se hace la constante para guardar la ruta de donde esta el archivo PHP con la busqueda
//const BASE_API = 'http://192.168.0.223:80/atenea/config.php?opcion=1';
const BASE_API = 'http://192.168.0.223:80/atenea/'
class Api {
    //Hacemos la función asincrona
     getSuggestion(archivo) {
        //Hacemos una constante donde haremos toda la consulta de la consulta (redundante no?), fijate que despues del nombre del archivo va "?opcion=1" esto es importante ya que con esto podemos elegir que acción hará el archivo de consulta en PHP.
        fetch(`${BASE_API}`+`${archivo}`)
        .then((response) => response.json())
        .then((data) => {
          return data;
        })
        .catch((error) => console.error(error))
        .finally(() => {
        });
        return data
        // Aqui ya solo retorno la constante "query" para que DidMount lo recupere y obtenga los datos y lo arroje en los estados.
        //return query;
    }
}
export default new Api;