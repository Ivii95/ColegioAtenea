import React, { Component } from 'react';
import { StyleSheet, View, ScrollView, Text, Linking } from 'react-native';
import ContainerLayout from '../Layouts/ZonaDeComunicacion.layout'
import * as G from '../../../functions/GLOBALES'
import { FlatList } from 'react-native-gesture-handler';
import styles from '../../../css/main';
const rojo = '#663e45';
const amarillo = '#ffcc67'
class Body extends Component {
  constructor(props) {
    super(props)
  }

  render() {
    const arrayObjComunicacion = Object.values(this.props.data);

    const Item = ({ id, asignatura, fecha, materia, profesor, titulo, url }) => (
      <Text style={style.item }>
        <Text style={style.titulo1}>Fecha: </Text><Text style={style.titulo2}>{"\n"}{fecha+"\n"}</Text> 
        <Text style={style.titulo1}>Area: </Text><Text style={style.titulo2}>{"\n"}{asignatura}{"\n"}</Text>
        <Text style={style.titulo1}>Titulo: </Text><Text style={style.titulo2}>{"\n"}{titulo}{"\n"}</Text>
        <Text style={style.titulo1}>Profesor: </Text><Text style={style.titulo2}>{"\n"}{profesor}{"\n"}</Text>
        {/*
        Contenido: {url}{"\n"}
      Materia: {materia}{"\n"}
      Id: {id}{"\n"}
      */}
        <Text style={{ color: 'blue', paddingVertical: 10,fontSize: 20 }}
          onPress={() => Linking.openURL(url)}>
          Ver contenido
        </Text>
      </Text>
    );

    const renderItem = ({ item }) => (
      <Item id={item.id} asignatura={item.asignatura} fecha={item.fecha} materia={item.materia} profesor={item.profesor} titulo={item.titulo} url={item.url} />
    );

    return (
      <View style={styles.body}>
        <View style={styles.col}>
          <FlatList
            data={arrayObjComunicacion}
            renderItem={renderItem}
          />
        </View>
      </View>
    )
  }
}
const style = StyleSheet.create({
  
  container: { flex: 1, padding: 16, paddingTop: 30, backgroundColor: '#fff' },
  head: { height: 40, backgroundColor: '#f1f8ff' },
  wrapper: { flexDirection: 'row' },
  title: { flex: 1, backgroundColor: '#f6f8fa' },
  row: { height: 28 },
  text: {textAlign: 'center'},
  titulo1:{
    marginVertical: 10,
    paddingVertical: 10,
    borderWidth: 4,
    borderColor: "#20232a",
    borderRadius: 6,
    color: amarillo,
    textAlign: "left",
    fontSize: 12,
    fontWeight: "bold"
  },titulo2:{
    paddingVertical: 10,
    borderWidth: 4,
    borderColor: "#20232a",
    borderRadius: 6,
    color: amarillo,
    textAlign: "left",
    fontSize: 20,
    fontWeight: "bold"
  },
  item: {
    width: '75%',
    height: 300,
    backgroundColor: rojo,
    padding: 20,
    paddingVertical: 10,
    marginVertical: 5,
    marginHorizontal: 10,
    borderRadius: 25,
    textAlign: 'left',
    color: amarillo,
    fontWeight: "bold"
  }
});
export default Body