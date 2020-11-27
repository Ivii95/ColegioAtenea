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
            id: G.ID_ALUMNO,
            header: G.NAME,
            footer: 'Usuario Alumno: ' + G.USERNAME
        }
    }
    async componentDidMount() {
        console.log('Entra en: ' + G.SELECT_ALUMNO)
        await fetch(G.SELECT_ALUMNO)
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
        const isLoading = this.state.isLoading
        let id = this.state.id
        let header = this.state.header
        let footer = this.state.footer
        return (
            <View style={{ flex: 1 }}>
                <Header text={header} />
                <Body
                    id={id}
                    name={G.NAME}
                    curso='S3A'
                    tutor='Juan Carlos Merchán Salas'
                    tutorias='Miércoles, de 08:20 - 09:15 h.'
                />
                <Footer footer={footer} />
            </View>
        );
    }
}
export default Alumno