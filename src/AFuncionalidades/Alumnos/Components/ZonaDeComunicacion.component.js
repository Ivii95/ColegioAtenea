import React, { Component } from 'react';
import { StyleSheet, View, ScrollView } from 'react-native';
import { Table, Row, Rows } from 'react-native-table-component';
import ContainerLayout from '../Layouts/ZonaDeComunicacion.layout'
import * as G from '../../../functions/GLOBALES'
class Body extends Component {
  constructor(props) {
    super(props);
    this.state = {
      data: props.data
    }
  }
  renderRow() {
    return (
      tableData.add['a', 'b', 'c', 'd']
    );
  }
  render() {
    const state = this.state;
    return (
      <ContainerLayout
        data={state.data}
      />
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