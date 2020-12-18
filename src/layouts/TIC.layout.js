
import React from 'react'
import { ImageBackground, TouchableHighlight, View } from 'react-native'
import styles from '../css/main'
import Functions from '../functions/Functions'

function ContainerLayout() {
    return (
        <TouchableHighlight onPress={() => Functions.mandarPrincipal()}>
            <ImageBackground source={require("../img/ticcamara.jpg")} style={{ height: 500, width: '100%' }}>
            </ImageBackground>
        </TouchableHighlight>
    )
}
export default ContainerLayout