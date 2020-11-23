import React, { useState } from 'react'
import { SafeAreaView, View, Text, ImageBackground, TouchableHighlight, FlatList } from 'react-native'
import { ScrollView } from 'react-native-gesture-handler';
import styles from '../css/main'
import * as RootNavigation from '../functions/RootNavigation.js';


const Item = ({ url }) => (

    <TouchableHighlight>
        <ImageBackground source={url} style={styles.colBot} >
        </ImageBackground>
        {/*<Text style={styles.tituloamarillo}>{title}</Text>*/}
    </TouchableHighlight>
);
function body(props) {
    const renderItem = ({ item }) => (
        <Item url={item.url} />
    );
    const [nombre, setNombre] = useState(props.name);
    const curso = props.curso, tutor = props.tutor, tutorias = props.tutorias;
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