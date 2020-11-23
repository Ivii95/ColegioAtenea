import React, { useState } from 'react'
import { View, Text, ImageBackground, ScrollView, TouchableHighlight } from 'react-native'
import { FlatList } from 'react-native-gesture-handler';
import styles from '../css/main'

const imagenAlumno = { uri: "https://colegioatenea.es/atenea/admin/imagenesAlumnos/485/485.JPG" };


function body(props) {
    const Item = ({ url, title }) => (

        <TouchableHighlight onPress={() => setNombre(title)}>
            <ImageBackground source={url} style={styles.colBot} >
            </ImageBackground>
            {/*<Text style={styles.tituloamarillo}>{title}</Text>*/}
        </TouchableHighlight>
    );
    const renderItem = ({ item }) => (
        <Item url={item.url} title={item.title} />
    );
    const [nombre, setNombre] = useState(props.name);
    const curso = props.curso, tutor = props.tutor, tutorias = props.tutorias;
    return (
        <View style={styles.body}>
            <View style={styles.row}>
                <ImageBackground source={imagenAlumno} style={styles.colFoto}>
                </ImageBackground>
                <View style={styles.colTop}>
                    <Text>Nombre: {nombre}</Text>
                    <Text>Curso: {curso}</Text>
                    <Text>Tutor: {tutor}</Text>
                    <Text>Tutorias: {tutorias}</Text>
                </View>
            </View>
            <View style={styles.col}>
                <FlatList
                    data={props.Items}
                    renderItem={renderItem}
                    keyExtractor={item => item.id}
                />
            </View>
        </View>
    )
}
export default body