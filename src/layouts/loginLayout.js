import React, { useState } from 'react'
import { View, Text, TextInput, Button } from 'react-native'
import styles from '../css/main'
import Functions from '../functions/Functions'
import * as G from '../functions/GLOBALES'
import md5 from "react-native-md5";

const login = (props) => {
    profesores = () => {

        if ('alumno' == userName && '1234' == passWord) {
            Functions.login(G.ALUMNO);
        } else if ('padres' == userName && '1234' == passWord) {
            Functions.login(G.PADRES);
        } else {
            for (const datos of dataProfesores) {
                let passMD5=md5.hex_md5(passWord)
                if (datos.usuario == userName && datos.clave == passMD5) {
                    G.ID = datos.id
                    G.NAME = datos.nombre +' '+ datos.apellidos
                    Functions.login(G.PROFESOR);
                }
            }
        }
    }

    const dataProfesores = props.data
    const [log, setLog] = useState('');
    const [userName, setUserName] = useState('');
    const [passWord, setPassWord] = useState('');
    return (
        <View style={styles.body}>
            <View style={{ marginVertical: 20 }}>
                <Text style={styles.negrita}>Bienvenido</Text>
            </View>
            <Text style={styles.textos}>Usuario:</Text>
            <TextInput
                inlineImageLeft='search_icon'
                style={styles.input}
                onChangeText={(text) => setUserName(text)}
                placeholder='Usuario...'
                textContentType='username'
            />
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
                        profesores()//Functions.login({ username: userName, password: passWord }) //username={userName} password={passWord} />
                    }}
                />
                <Text>{log}</Text>
            </View>
        </View>
    )
}
export default login