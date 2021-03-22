import React, { Component } from 'react';
import { StyleSheet, View, ScrollView } from 'react-native';
import { Table, Row, Rows } from 'react-native-table-component';
import ContainerLayout from '../Layouts/ZonaDeComunicacion.layout'
import * as G from '../../../functions/GLOBALES'
class Body extends Component {
  constructor(props) {
    super(props)
    this.state = {
      headerData: ["ID","Fecha", "Materia", "Asign", "Url", "Titulo","Profesor"],//initialisation of header of table
      tableContents: []
    }//initialisation of table contents
  }

  /*renderRow() {
    return (
      tableData.add['a', 'b', 'c', 'd']
    );
  }*/
  render() {
    const arrayEntries = Object.values(this.props.data);
    const valores=[];
    for(let i = 0; i < arrayEntries.length; i++){
    Object.entries(arrayEntries[i]).map(([key, value]) => {
      console.log(`${key}: ${value}`);
      valores.push(value);
     // arrayEntries.push(`${key}: ${value}`);
      // Pretty straightforward - use key for the key and value for the value.
      // Just to clarify: unlike object destructuring, the parameter names don't matter here.
    })
  }
    console.log(arrayEntries);
    console.log(valores);
    console.log('*****************************************************************************************************************');
    console.log('*****************************************************************************************************************');
    console.log('*****************************************************************************************************************');
    console.log('*****************************************************************************************************************');
    //console.log(this.props.data);
    //console.log(this.props.data[0]);

    const state = this.state;
    return (
      <View>
        <Table>
          <Row data={state.headerData} />
          <Rows data={state.tableContents} />
        </Table>
      </View>
    )


    // Funcionando para un elemento
    {/*for (const [key, value] of Object.entries(this.props.data)) {
      console.log(`${key}: ${value}`);
      return (
        <ContainerLayout
          data={value}
        />
      )
    }*/}

    const datosComu = this.props.data;
    //console.log('********************* MOSTRANDO LA DATA DESDE EL COMPONENT *********************');
    //console.log(datosComu[0]);
    return (
      <ContainerLayout
        data={datosComu}
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