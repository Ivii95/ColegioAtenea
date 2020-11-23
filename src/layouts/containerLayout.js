import React from 'react'
import {View,Text} from 'react-native'
import styles from '../css/main'
function body(props){
    return(
        <View style={styles.body}>
            <Text>{props.message}</Text>
        </View>
    )
}
export default body