import React from 'react'
import { View, Text, Image } from 'react-native'
import styles from '../css/stylesHeaderFooter'
function Header() {
    return (
        <View style={{ flex: 1 }}>
            <View style={styles.headerTop}>
                <Image
                    style={styles.imagenAteneaArriba}
                    source={require('../img/Cartel-logo.png')}
                />
            </View>
            <View style={styles.headerBot}>
                <Text>Colegio Atenea Mérida</Text>
            </View>
        </View>
    )
}
export default Header