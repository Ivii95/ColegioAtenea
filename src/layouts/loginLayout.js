import React from 'react'
import { View, Text, TextInput, Button } from 'react-native'
import body from '../css/stylesHeaderFooter'
import styles from '../css/style'
import Functions from '../functions/Functions'
import { FontAwesome, Ionicons } from '@expo/vector-icons'
function login(props) {
    let loginAcepted = () => { Alert.alert('Usuario y Contraseña: Correcto') }
    return (
        <View style={body.body}>
            <View style={{ marginVertical: 20 }}>
                <Text style={styles.negrita}>Bienvenido</Text>
            </View>
            <Text style={styles.textos}><FontAwesome name='user' size={20}></FontAwesome> Usuario: {props.username}</Text>
            <TextInput
                inlineImageLeft='search_icon'
                style={styles.input}
                onChangeText={(text) => ({ username: text })}
                placeholder='Usuario...'
                textContentType='username'
            />
            
            <Text style={styles.textos}> <Ionicons name='md-lock' size={20}></Ionicons> Contraseña: {props.password}</Text>
            <TextInput
                inlineImageLeft='search_icon'
                style={styles.input}
                onChangeText={text => ({ password: text })}
                placeholder='Contraseña...'
                textContentType='password'
                secureTextEntry
            />
            <View style={{ marginVertical: 20 }}>
                <Button
                    title="Acceder"
                    onPress={() => { Alert.alert('Usuario y Contraseña: Correcto') }}
                />
            </View>
        </View>
    )
}
export default login