import React from 'react';
import {
  Button, StyleSheet, Alert, Text, TextInput, View, Image,
} from 'react-native';
import { StatusBar } from 'expo-status-bar';
import styles from '../css/style';
//var alumnos = require('../components/alumnos')


export class Login extends React.Component {
  constructor() {
    super()
    this.state = {
      username: '',
      password: '',
      loading: false,
      message: 'Aplicaciones-NT'
    }
  }
  saludo = () => { Alert.alert ('Prueba de alerta') }
  /*getLoading(){
    return this.state.loading;
  }; */
  onChangeUser(user) {
    setState({ username: user });
  }
  /*login = async () => {
    if (state.username && state.password) {
      this.authenticate(state.username, state.password)
    }
  }
  props
  componentDidMount() {
    this.login()
  }*/

  authenticate = (username, password) => {
    if (username == 'ivan' && password == '1234') {
      this.setState({ loading: true, message: "LOGUEADO" })
    } else {
      this.setState({ loading: true, message: "ERROR NO LOGUEADO" })
    }
  }
  render() {
    return (
      <View style={styles.container1} >
        <Image
          style={styles.imagenAteneaArriba}
          source={require('../img/Cartel-logo.png')}
        />
        <StatusBar style="auto" />
        <View style={styles.container2}>
          <View style={styles.container3}>
            {/*<Text style={{backgroundColor:'#000', color:'white'}}>COLEGIO ATENEA</Text>*/}
            {/*<alumnos></alumnos>*/}
            <Text style={styles.textos}>Usuario:</Text>
            <TextInput
              inlineImageLeft='search_icon'
              style={styles.input}
              onChangeText={(text) => this.setState({ username: text })}
              placeholder='Usuario...'
              textContentType='username'
            />
            <Text style={styles.textos}>Contraseña:</Text>
            <TextInput
              inlineImageLeft='search_icon'
              style={styles.input}
              onChangeText={text => this.setState({ password: text })}
              placeholder='Contraseña...'
              textContentType='password'
              secureTextEntry
            />
          </View>
          <View style={{ marginTop: 20 }}>
            <Button
              title="Acceder"
              onPress={() => this.authenticate(this.state.username, this.state.password)}
            />
          </View>
          <Image
            style={styles.imagenAteneaAbajo}
            source={require('../img/final-logo.png')}
          />
        </View>
        <Text style={{ color: 'blue', marginTop: 10 }}>{this.state.username}</Text>
        <Text style={{ color: 'blue', marginTop: 10 }}>{this.state.password}</Text>
        <Text style={{ color: 'blue', marginTop: 10 }}>{this.state.message}</Text>
      </View>
    )
  }
}