import  React  from "react"
import { View, Text, Stylesheet } from 'react-native'
import styles from '../css/style'

function AppLayout() {
    
    return(
        <View style={styles.header} >
        <Image
          style={styles.imagenAteneaArriba}
          source={require('../img/Cartel-logo.png')}
        />
        <StatusBar style="auto"/>
        <View style={styles.footer}>
          <View style={styles.container}>
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
export default AppLayout