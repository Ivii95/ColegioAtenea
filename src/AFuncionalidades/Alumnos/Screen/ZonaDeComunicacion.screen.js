import React, { Component } from 'react'
import { View } from 'react-native'
//SMART COMPONENTS
import Header from '../../../components/header';
//Aqui definimos que el body sea el de un profesor para que pueda acceder a los datos de el mismo.
import Body from '../Components/ZonaDeComunicacion.component';
import Footer from '../../../components/footer';
//VARIABLES GLOBALES
import * as G from '../../../functions/GLOBALES'

//Este es el componente principal de los Profesores.
class Screen extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            isLoading: true,
            //Cogemos el id y el nombre de las variables globales que hemos cogido al registrarse.
            id: G.ID_PROFESOR,
            header: G.NAME,
            footer: 'Usuario Profesor: ' + G.USERNAME,
        }
    }
    async componentDidMount() {
        console.log('Entra en: ' + G.SELECT_ALUMNO_COMUNICACIONES+ G.ID_ALUMNO)
        await fetch(G.SELECT_ALUMNO_COMUNICACIONES + G.ID_ALUMNO)
            .then((response) => response.json())
            .then((data) => {
                //console.log(data)
                this.setState({ data: data });
            })
            .catch((error) => console.error(error))
            .finally(() => {
                this.setState({ isLoading: false });
            });
    }
    render() {
        //let id = this.state.id
        const data = this.state.data
        let header = this.state.header
        let footer = this.state.footer
        //console.log(this.state.data);
        return (
            //Aqui definimos el primer View como flex 1 para que ocupe toda la pantalla.
            //Despues añadimos el Header el Body y el Footer.
            //Pasamos el ID al body para que se pueda avisar a la base de datos para coger los datos de ese profesor.
            <View style={{ flex: 1 }}>
                <Header text={header} />
                <Body data={data} />
                <Footer footer={footer} />
            </View>
        );
    }
}
//Por ultimo lo exportamos para que pueda crearse al llamar a la clase.
export default Screen