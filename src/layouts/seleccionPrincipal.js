import React, { useState } from 'react'
import { SafeAreaView, View, Text, ImageBackground, TouchableHighlight, FlatList } from 'react-native'
import styles from '../css/main'
import Functions from '../functions/Functions'

function body(props) {
    acceso = (title) => {
        Functions.mandarLogin(title)
    }
    const Item = ({ url, title }) => (
        <TouchableHighlight onPress={() => acceso(title)}>
            <ImageBackground source={url} style={styles.BotonesInicio}/>
        </TouchableHighlight>
    );
    const renderItem = ({ item }) => (
        <Item url={item.url} title={item.title} />
    );
    const [nombre, setNombre] = useState(props.name);
    return (
        <View style={styles.body}>
            <SafeAreaView style={styles.col}>
                <FlatList
                    data={props.Items}
                    renderItem={renderItem}
                    keyExtractor={item => item.id}
                />
            </SafeAreaView>
        </View>
    )
}
export default body