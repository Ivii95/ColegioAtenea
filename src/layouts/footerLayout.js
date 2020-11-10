import React from 'react'
import { View, Text, Image } from 'react-native'
import styles from '../css/stylesHeaderFooter'
function Footer() {
    return (
        <View style={{flex:1}}>
            <View style={styles.footerTop}>
            <Image
            style={styles.imagenAteneaAbajo}
            source={require('../img/final-logo.png')}
          />
            </View>
            <View style={styles.footerBot}>
                <Text style={{color:'blue'}}>Aplicaciones-NT</Text>
            </View>
        </View>
    )
}
export default Footer