import React from 'react'
import { View, StyleSheet, Table, Row, TableWrapper, Col, Rows, Text, FlatList } from 'react-native'
//import styless from '../../../css/main'

function ContainerLayout(props) {

    const arrayEntries = Object.values(props.data);
    console.log('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
    console.log('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
    console.log('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
    console.log('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
    console.log(arrayEntries);

    return (
<       View style={styles.container}>

        </View>
)
        {/*<View style={styles.container}>
            <Text>Asignatura: {datosObj.asignatura}</Text>
            <Text>Fecha: {datosObj.fecha}</Text>
            <Text>Id: {datosObj.id}</Text>
            <Text>Materia: {datosObj.materia}</Text>
            <Text>Profesor: {datosObj.profesor}</Text>
            <Text>Titulo: {datosObj.titulo}</Text>
            <Text>Url: {datosObj.url}</Text>
    </View>*/}
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
