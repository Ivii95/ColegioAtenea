import React from 'react'
import { View, StyleSheet, Table, Row, TableWrapper, Col, Rows, Text, FlatList } from 'react-native'
//import styless from '../../../css/main'

function ContainerLayout(props) {
    const renderItem = ({ item }) => (
        <View style={styles.row}>
            <Text>Feo{item.titulo}</Text>
        </View>
    );
    return (
        <View style={styles.col}>
            <Text>Feo{props.data.titulo}</Text>
            <FlatList
                data={props.data}
                renderItem={renderItem}
                keyExtractor={item => item.id}
            />
        </View>
    )
}
const styles = StyleSheet.create({
    container: { flex: 1, padding: 16, paddingTop: 30, backgroundColor: '#fff' },
    head: { height: 40, backgroundColor: '#f1f8ff' },
    wrapper: { flexDirection: 'row' },
    title: { flex: 1, backgroundColor: '#f6f8fa' },
    row: { height: 28 },
    text: { textAlign: 'center' }
});
export default ContainerLayout
