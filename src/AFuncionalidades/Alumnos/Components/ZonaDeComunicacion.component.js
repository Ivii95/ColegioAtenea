import React, { Component } from 'react';
import { StyleSheet, View, ScrollView, Text } from 'react-native';
import ContainerLayout from '../Layouts/ZonaDeComunicacion.layout'
import * as G from '../../../functions/GLOBALES'
import { FlatList } from 'react-native-gesture-handler';
class Body extends Component {
  constructor(props) {
    super(props)
  }

  render() {
    const arrayObjComunicacion = Object.values(this.props.data);

    const Item = ({ id, asignatura, fecha, materia, profesor, titulo, url }) => (
      <Text>Id: {id}{"\n"}
      Asignatura: {asignatura}{"\n"}
      Fecha: {fecha}{"\n"}
      Materia: {materia}{"\n"}
      Profesor: {profesor}{"\n"}
      Titulo: {titulo}{"\n"}
      Url: {url}{"\n"}</Text>
    );

    const renderItem = ({ item }) => (
      <Item id={item.id} asignatura={item.asignatura} fecha={item.fecha} materia={item.materia} profesor={item.profesor} titulo={item.titulo} url={item.url} />
    );

    return (
      <View style={styles.container}>
        <View style={styles.colTop}>
          <FlatList
            data={arrayObjComunicacion}
            renderItem={renderItem}
          />
        </View>
      </View>
    )
  }
}

const styles = StyleSheet.create({
  container: { flex: 3, padding: 16, paddingTop: 30, backgroundColor: '#fff' },
  head: { height: 40, backgroundColor: '#f1f8ff' },
  wrapper: { flexDirection: 'row' },
  title: { flex: 1, backgroundColor: '#f6f8fa' },
  row: { height: 28 },
  text: { textAlign: 'center' }
});
export default Body