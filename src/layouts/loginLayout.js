import React, { useState } from 'react'
import { View, Text, TextInput, Button } from 'react-native'
import styles from '../css/main'
import Functions from '../functions/Functions'
import * as G from '../functions/GLOBALES'
import md5 from "react-native-md5";


const login = (props) => {
    acceso = () => {
        //Aqui comprobamos quien se esta logueando y sacamos los datos del usuario si coincide.
        if (G.SELECCION == G.PROFESOR) {
            //PROFESOR
            for (const datos of data) {
                let passMD5 = md5.hex_md5(passWord)
                if (datos.usuario == userName && datos.clave == passMD5) {
                    G.ID = datos.id
                    G.NAME = datos.nombre + ' ' + datos.apellidos
                    Functions.login(G.PROFESOR);
                }
            }
        } else {
            //ALUMNO Y PADRES
            for (const datos of data) {
                if (datos.usuario == userName && datos.clave == passWord) {
                    G.ID = datos.id
                    G.NAME = datos.nombre + ' ' + datos.apellidos
                    if (G.SELECCION == G.ALUMNO) {
                        Functions.login(G.ALUMNO);
                    } else {
                        Functions.login(G.PADRES);
                    }
                }
            }
        }


    }
    const data = props.data
    const [log, setLog] = useState('');
    const [userName, setUserName] = useState('');
    const [passWord, setPassWord] = useState('');
    return (
        <View style={styles.body}>
            <View style={{ marginVertical: 20 }}>
                <Text style={styles.negrita}>Bienvenido</Text>
            </View>
            {
                //USUARIO
            }
            <Text style={styles.textos}>Usuario:</Text>
            <TextInput
                inlineImageLeft='search_icon'
                style={styles.input}
                onChangeText={(text) => setUserName(text)}
                placeholder='Usuario...'
                textContentType='username'
            />
            {
                //CONTRASEÑA
            }
            <Text style={styles.textos}>Contraseña:{md5.hex_md5(passWord)}</Text>
            <TextInput
                inlineImageLeft='search_icon'
                style={styles.input}
                onChangeText={text => setPassWord(text)}
                placeholder='Contraseña...'
                textContentType='password'
                secureTextEntry
            />
            <View style={{ marginVertical: 20 }}>
                <Button
                    title="Acceder"
                    onPress={() => {
                        acceso()//Functions.login({ username: userName, password: passWord }) //username={userName} password={passWord} />
                    }}
                />
                <Text>{log}</Text>
            </View>
        </View>
    )
}
export default login