import React, { useState } from 'react'
import { SafeAreaView, View, Text, ImageBackground, TouchableHighlight, FlatList, SectionList, VirtualizedList } from 'react-native'
import { ScrollView } from 'react-native-gesture-handler';
import styles from '../css/main'
import * as RootNavigation from '../functions/RootNavigation.js';
import * as G from '../functions/GLOBALES'

function body(props) {
    redireccion = (id) => {
        G.ID_ALUMNO = this.id;
        RootNavigation.navigate('Alumno', id)
    }
    const ItemA = ({ id, title }) => (
        <View style={styles.item}>
            <TouchableHighlight onPress={() => redireccion(id)}>
                <Text style={styles.tituloamarillo}>{title}</Text>
            </TouchableHighlight>
        </View>
    );
    const Item = ({ url }) => (
        <TouchableHighlight>
            <ImageBackground source={url} style={styles.colBot} />
        </TouchableHighlight>
    );
    const renderItem = ({ item }) => (
        item.ide === 'funcion' ? <Item url={item.url} /> : <ItemA title={item.id, item.title} />
    );
    return (
        <View style={styles.body}>
            <SafeAreaView style={styles.col}>
                <FlatList
                    data={props.Hijos}
                    renderItem={renderItem}
                    keyExtractor={item => item.id.toString()}
                />
            </SafeAreaView>
        </View>
    )
}

export default body