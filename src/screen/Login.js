import React, { Component } from 'react'
import { View } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
//Nos aseguramos de que el componente al que acceda sea el de login.
import Body from '../components/login';
import Footer from '../components/footer';
//VARIABLES GLOBALES
import * as G from '../functions/GLOBALES'

class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            isLoading: true
        };
    }
    //Este metodo recoge un JSON de el servidor.
    async componentDidMount() {
        //Aqui definimos la URL del archivo del servidor para poder recoger los datos.
        switch (G.SELECCION) {
            case G.ALUMNO:
                console.log('Entra en: ' + G.DB_ALUMNO)
                await fetch(G.DB_ALUMNO)
                    .then((response) => response.json())
                    .then((data) => {
                        this.setState({ data: data });
                    })
                    .catch((error) => console.error(error))
                    .finally(() => {
                        this.setState({ isLoading: false });
                    });
                break;
            case G.PADRES:
                console.log('Entra en: ' + G.DB_PADRES)
                await fetch(G.DB_PADRES)
                    .then((response) => response.json())
                    .then((data) => {
                        this.setState({ data: data });
                    })
                    .catch((error) => console.error(error))
                    .finally(() => {
                        this.setState({ isLoading: false });
                    });
                break;
            case G.PROFESOR:
                console.log('Entra en: ' + G.DB_PROFESOR)
                await fetch(G.DB_PROFESOR)
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data)

                        this.setState({ data: data });
                    })
                    .catch((error) => console.error(error))
                    .finally(() => {
                        this.setState({ isLoading: false });
                    });
                break;
            default:
                break;
        }
    }
    render() {
        //Se definenen las variables del componente para generarlo.
        const data = this.state.data
        const isLoading = this.state.isLoading
        //Se crean los diferentes componentes Header, Body y Footer para mostrar la pagina.
        return (
            <View style={{ flex: 1 }}>
                <Header text={'Bienvenido '+G.SELECCION} />
                {
                    //Datos para Body
                }
                <Body data={this.state.data} />
                {
                    //Texto para mostrar en el footer
                }
                <Footer footer={'Aplicaciones-NT'} />
            </View>
        );
    }
}
export default Login