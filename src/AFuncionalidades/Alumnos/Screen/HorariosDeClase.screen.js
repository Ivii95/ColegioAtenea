import React, { Component } from 'react'
import { View } from 'react-native'
//SMART COMPONENTS
import Header from '../../../components/header';
//Aqui definimos que el body sea el de un profesor para que pueda acceder a los datos de el mismo.
import Body from '../Components/HorariosDeClase.component';
import Footer from '../../../components/footer';
//VARIABLES GLOBALES
import * as G from '../../../functions/GLOBALES'

//Este es el componente principal de los Profesores.
class Screen extends Component {
    render() {
        return (
            //Aqui definimos el primer View como flex 1 para que ocupe toda la pantalla.
            //Despues añadimos el Header el Body y el Footer.
            //Pasamos el ID al body para que se pueda avisar a la base de datos para coger los datos de ese profesor.
            <View style={{ flex: 1 }}>
                <Header text={'Horarios de Clase'}/>
                <Body/>
                <Footer footer={G.NAME} />
            </View>
        );
    }
}
//Por ultimo lo exportamos para que pueda crearse al llamar a la clase.
export default Screen