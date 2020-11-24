import React, { Component } from 'react';
import { ActivityIndicator, FlatList, Text, View } from 'react-native';
import api from '../functions/apivi'
import funciones from '../functions/Functions'
export default class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      data: [],
      isLoading: true
    };
  }
  async componentDidMount() {
    await fetch('http://192.168.0.223:80/atenea/config.php?opcion=Profesor')
      .then((response) => response.json())
      .then((data) => {
        console.log(data)
        this.setState({ data: data });
      })
      .catch((error) => console.error(error))
      .finally(() => {
        this.setState({ isLoading: false });
      });
  }
  /*componentDidMount() {
    var datos = funciones.obtenerDatos(
      'http://192.168.0.223:80/atenea/prueba.json')
    console.log(datos)
    this.setState({ data: datos });
  }*/

  /*componentDidMount() {
   fetch('http://192.168.0.223:80/atenea/prueba.json')
     .then((response) => response.json())
     .then((data) => {
       this.setState({ data: data });
     })
     .catch((error) => console.error(error))
     .finally(() => {
       this.setState({ isLoading: false });
     });
 }*/
  render() {
    const { data, isLoading } = this.state;
    return (
      <View style={{ flex: 1, padding: 50 }}>
        {isLoading ? <ActivityIndicator /> : (
          <FlatList
            data={data}
            keyExtractor={({ id }, index) => id}
            renderItem={({ item }) => (
              <Text>{item.nombre}</Text>
            )}
          />
        )}
      </View>
    );
  }
};