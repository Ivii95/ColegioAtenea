import { StyleSheet } from "react-native"

const rojo = '#663e45';
const amarillo = '#ffcc67'
export default StyleSheet.create({
   headerTop: {
      flex: 3,
      flexDirection: 'column',
      backgroundColor: amarillo,
      alignItems: 'center',
      justifyContent: 'center',
   },
   headerBot: {
      flex: 1,
      flexDirection: 'column',
      backgroundColor: rojo,
      alignItems: 'center',
      justifyContent: 'center',
   }, footerTop: {
      flex: 3,
      flexDirection: 'column',
      backgroundColor: rojo,
      alignItems: 'center',
      justifyContent: 'center',
   }, footerBot: {
      flex: 1,
      flexDirection: 'column',
      backgroundColor: amarillo,
      alignItems: 'center',
      justifyContent: 'center',
   }, body: {
      flex: 4,
      flexDirection: 'column',
      alignContent: 'center',
      backgroundColor: '#a4b2bf',
      alignItems: 'center',
      justifyContent: 'center',
   },
   imagenAteneaArriba: {
      width: 312,
      height: 61,
      marginTop: 20
   },
   imagenAteneaAbajo: {
      width: 312,
      height: 61,
   }, textos: {
      marginTop: 20,
      width: '50%',
      height: 30,
      borderColor: 'gray',
      borderWidth: 0
   }, input: {
      width: '50%',
      height: 50,
      borderColor: 'gray',
      borderWidth: 1
   }, negrita: {
      fontWeight: 'bold'
   }, row: {
      width: '95%',
      height: '95%',
      flex: 1,
      flexDirection: 'row',
      justifyContent: 'space-between'
   }, col: {
      width: '95%',
      flex: 2,
      flexDirection: 'column',
      justifyContent: 'center',
      alignItems: 'center',
      alignContent: 'center'
   }, colFoto: {
      flex: 1,
      height: '95%',
      marginTop: 5,
      marginHorizontal: '2%',
      textAlign: 'center'
   }, colTop: {
      flex: 2,
      height: '90%',
      marginTop: 5,
      marginHorizontal: '2%',
      backgroundColor: amarillo,
      alignItems: 'center',
      paddingVertical: '10%',
      marginVertical: 10,
      borderRadius: 25

   }, colBot: {
      flex: 1,
      width: 300,
      height: 200,
      marginVertical: 10,
      marginHorizontal: 10,
      alignItems: 'center',
      alignContent: 'center',
      borderRadius: 25
   }, BotonesInicio: {
      flex: 1,
      width: 290,
      height: 160,
      marginVertical: 10,
      marginHorizontal: 10,
      alignItems: 'center',
      alignContent: 'center',
      borderRadius: 25
   }, item: {
      width: 300,
      height: 100,
      backgroundColor: rojo,
      padding: 30,
      marginVertical: 10,
      marginHorizontal: 10,
      borderRadius: 25
   },
   title: {
      fontSize: 32,
   }, textos: {
      marginTop: 20,
      width: '50%',
      height: 30,
      borderColor: 'gray',
      borderWidth: 0
   }, input: {
      width: '50%',
      height: 50,
      borderColor: 'gray',
      borderWidth: 1
   }, negrita: {
      fontWeight: 'bold'
   }, rojo: {
      color: rojo
   }, amarillo: {
      color: amarillo
   }, titulorojo: {
      color: rojo,
      fontSize: 32,
      fontWeight: 'bold'
   }, tituloamarillo: {
      color: amarillo,
      fontSize: 32,
      fontWeight: 'bold'
   }
});