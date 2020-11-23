import React from 'react'
import { } from "react-native"



//Se hace la constante para guardar la ruta de donde esta el archivo PHP con la busqueda
//const BASE_API = 'http://192.168.0.223:80/atenea/config.php?opcion=1';
const BASE_API='http://192.168.0.223/atenea/prueba.json'
class Api {
    //Hacemos la función asincrona
    async getSuggestion() {
        //Hacemos una constante donde haremos toda la consulta de la consulta (redundante no?), fijate que despues del nombre del archivo va "?opcion=1" esto es importante ya que con esto podemos elegir que acción hará el archivo de consulta en PHP.
        const query = await fetch(`${BASE_API}`, {
            //Le indico que la consulta es de forma POST
            method: 'POST',
            mode:'no-cors',
            //Le indico que tipo de consulta va a obtener o su contenido
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*'
            },
            //Le indico que el cuerpo es un JSON y quiero que lo convierta así.
            //body: JSON.stringify()
        }).then((response) => response.json()) //Si es así que realice un tipo mapeo
            .then((data) => { //Si obtiene los datos que lo guarde o haga un callback en "data"
                //Hago retornar "data" para que se guarde en la constante "query"
                console.log('funciona')
                return data
                
            }).catch((error) => {
                //Si no obtiene nada que me lo arroje en consola
                console.error(error);
            });
        // Aqui ya solo retorno la constante "query" para que DidMount lo recupere y obtenga los datos y lo arroje en los estados.
        return query;
    }
}
export default new Api;