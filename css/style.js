import { StyleSheet } from "react-native"

export default StyleSheet.create({
   header: {
      flex: 1,
      backgroundColor: '#ffcc67',
      alignItems: 'center',
      justifyContent: 'center',
   }, footer: {
      height: '80%',
      width: '100%',
      backgroundColor: '#663e45',
      alignItems: 'center',
      justifyContent: 'center',
   }, container: {
      height: '60%',
      width: '80%',
      backgroundColor: '#a4b2bf',
      alignItems: 'center',
      justifyContent: 'center',
   },
   imagenAteneaArriba:{
      width: 312,
      height: 61,
      marginVertical: 20 
   },
   imagenAteneaAbajo:{ 
      width: 312,
      height: 61,
      marginVertical: 20 
   },
   textos: {
      marginTop: 20,
      width: '80%',
      height: 30,
      borderColor: 'gray',
      borderWidth: 0
   },
   input: {
      width: '80%',
      height: 50,
      borderColor: 'gray',
      borderWidth: 1
   },negrita:{
      fontWeight:'bold'
   }
});