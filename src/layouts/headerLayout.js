import { useLinkProps } from '@react-navigation/native'
import React from 'react'
import { View, Text, Image, Linking, TouchableHighlight } from 'react-native'
import styles from '../css/main'
function Header(props) {
    return (
        <View style={{ flex: 1 }}>
            <View style={styles.headerTop}>
                <TouchableHighlight onPress={() => Linking.openURL('https://colegioatenea.es/')}>
                    <Image
                        style={styles.imagenAteneaArriba}
                        source={require('../img/Cartel-logo.png')}
                    />
                </TouchableHighlight>
            </View>
            <View style={styles.headerBot}>
                <Text style={styles.tituloamarillo}>{props.text}</Text>
            </View>
        </View>
    )
}
export default Header