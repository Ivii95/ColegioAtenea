import React, { useState } from 'react'
import { SafeAreaView, View, Text, ImageBackground, TouchableHighlight, FlatList, SectionList, VirtualizedList } from 'react-native'
import { ScrollView } from 'react-native-gesture-handler';
import styles from '../css/main'
import * as RootNavigation from '../functions/RootNavigation.js';

function body(props) {
    const ItemA = ({ title }) => (
        <View style={styles.item}>
            <TouchableHighlight onPress={() => RootNavigation.navigate('Alumno', title)}>
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
        item.ide === 'funcion' ? <Item url={item.url} /> : <ItemA title={item.title} />
    );
    return (
        <View style={styles.body}>
            <SafeAreaView style={styles.col}>
                <FlatList
                    data={props.Hijos}
                    renderItem={renderItem}
                    keyExtractor={item => item.id}
                />
            </SafeAreaView>
        </View>
    )
}

export default body