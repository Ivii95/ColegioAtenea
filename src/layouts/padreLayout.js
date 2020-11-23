import React, { useState } from 'react'
import { SafeAreaView, View, Text, ImageBackground, TouchableHighlight, FlatList } from 'react-native'
import { ScrollView } from 'react-native-gesture-handler';
import styles from '../css/main'
import * as RootNavigation from '../functions/RootNavigation.js';


const ItemA = ({ title }) => (
    <View style={styles.item}>
        <TouchableHighlight onPress={() => RootNavigation.navigate('Alumno', title)}>
            <Text style={styles.tituloamarillo}>{title}</Text>
        </TouchableHighlight>
    </View>
);
const Item = ({ url }) => (
    <TouchableHighlight>
        <ImageBackground source={url} style={styles.colBot} >
        </ImageBackground>
        {/*<Text style={styles.tituloamarillo}>{title}</Text>*/}
    </TouchableHighlight>
);
function body(props) {
    const renderItemA = ({ item }) => (
        <ItemA title={item.title} />
    );
    const renderItem = ({ item }) => (
        <Item url={item.url} />
    );
    const renderHijos = () => (
        <View style={styles.colTop}>
            <Text style={styles.titulorojo}>Hijo/s</Text>
            <Text></Text>
            <FlatList
                data={props.Hijos}
                renderItem={renderItemA}
                keyExtractor={item => item.id}
            />
        </View>
    );
    const [nombre, setNombre] = useState(props.name);
    const curso = props.curso, tutor = props.tutor, tutorias = props.tutorias;
    return (
        <View style={styles.body}>
            <SafeAreaView style={styles.col}>
                <ScrollView>
                    <TouchableHighlight>
                        <ImageBackground source={require('../img/micuenta.png')} style={styles.colBot} >
                        </ImageBackground>
                    </TouchableHighlight>
                    <TouchableHighlight>
                        <ImageBackground source={require('../img/circulares.png')} style={styles.colBot} >
                        </ImageBackground>
                    </TouchableHighlight>
                    <TouchableHighlight>
                        <ImageBackground source={require('../img/agenda.png')} style={styles.colBot} >
                        </ImageBackground>
                    </TouchableHighlight>
                    {renderHijos()}
                </ScrollView>
            </SafeAreaView>
        </View>
    )
}

export default body