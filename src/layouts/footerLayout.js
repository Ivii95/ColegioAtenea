import React from 'react'
import { View, Text, Image } from 'react-native'
import styles from '../css/main'
function Footer(props) {
    return (
        <View style={{ flex: 1 }}>
            <View style={styles.footerTop}>
                <Image
                    style={styles.imagenAteneaAbajo}
                    source={require('../img/final-logo.png')}
                />
            </View>
            <View style={styles.footerBot}>
                <Text style={{ color: 'blue' }}>{props.footer}</Text>
            </View>
        </View>
    )
}
export default Footer