import React, { useState } from 'react'
import { View, Text, ImageBackground, TouchableHighlight, Image } from 'react-native'
import { FlatList } from 'react-native-gesture-handler';
import styles from '../css/main'

//const imagenAlumno = { uri: "https://colegioatenea.es/atenea/admin/imagenesAlumnos/485/485.JPG" };


function body(props) {
    const Item = ({ url, title }) => (
        <TouchableHighlight onPress={() => setNombre(title)}>
            <ImageBackground source={url} style={styles.colBot}>
            </ImageBackground>
            {/*<Text style={styles.tituloamarillo}>{title}</Text>*/}
        </TouchableHighlight>
    );
    const renderItem = ({ item }) => (
        <Item url={item.url} title={item.title} />
    );
    const [nombre, setNombre] = useState(props.name);
    const urlimagen = props.data.urlimagen;
    return (
        <View style={styles.body}>
            <View style={styles.row}>
                <Image resizeMode="stretch" source={
                    urlimagen
                        ? {uri:urlimagen}
                        : require('../img/Logotipo-ATENEA.png')
                } style={styles.colFoto} />
                <View style={styles.colTop}>
                    <Text>Nombre: {props.data.nombre}</Text>
                    <Text>Curso: {props.data.curso}</Text>
                    <Text>Tutor: {props.data.tutor}</Text>
                    <Text>Tutorias: {props.data.horatutoria}</Text>
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