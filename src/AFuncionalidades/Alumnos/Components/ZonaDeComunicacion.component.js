import React, { Component } from 'react';
import { StyleSheet, View,ScrollView } from 'react-native';
import { Table, Row, Rows } from 'react-native-table-component';
import ContainerLayout from '../Layouts/ZonaDeComunicacion.layout'
import * as G from '../../../functions/GLOBALES'
class Body extends Component {
  constructor(props) {
    super(props);
    this.state = {
      data: props.data,
      tableHead: ['Nombre','Examenes y Tareas','Evaluaciones'],
      tableData: [
        ['Álvarez Gómez, Irene','Ver','Ver'],
        ['Bonilla Naranjo, Benito','Ver','Ver'],
        ['Calamonte Retamal, Guadalupe','Ver','Ver']
      ]
    }
  }
  renderRow() {
    return (
      tableData.add['a', 'b', 'c', 'd']
    );
  }
  render() {
    //const state = this.state;
    return (
      <View style={styles.container}>
        <ScrollView>
          <Table borderStyle={{ borderWidth: 2, borderColor: '#c8e1ff' }}>
            <Row data={this.state.tableHead} style={styles.head} textStyle={styles.text} />
            <Rows data={this.state.data} textStyle={styles.text} />
          </Table>
        </ScrollView>
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