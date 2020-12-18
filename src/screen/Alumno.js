import React, { Component } from 'react'
import { View } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/alumnos';
import Footer from '../components/footer';
import * as G from '../functions/GLOBALES'
class Alumno extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            isLoading: true,
            header: G.NAME,
            footer: 'Usuario Alumno: ' + G.USERNAME
        };
    }
    async componentDidMount() {
        console.log('Entra en: ' + G.SELECT_ALUMNO + G.ID_ALUMNO)
        await fetch(G.SELECT_ALUMNO + G.ID_ALUMNO)
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
    render() {
        const data = this.state.data
        let header = this.state.header
        let footer = this.state.footer
        return (
            <View style={{ flex: 1 }}>
                <Header text={header} />
                <Body data={data} />
                <Footer footer={footer} />
            </View>
        );
    }
}
export default Alumno