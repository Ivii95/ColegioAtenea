import React, { Component } from 'react'
import { View } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/padres';
import Footer from '../components/footer';

import * as G from '../functions/GLOBALES'
class Padres extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            isLoading: true,
            id: G.ID_PADRE,
            header: G.NAME,
            footer: 'Usuario Padres: ' + G.USERNAME
        }
    }
    async componentDidMount() {
        console.log('Entra en: ' + G.SELECT_PADRES + G.ID_PADRE)
        await fetch(G.SELECT_PADRES + G.ID_PADRE)
            .then((response) => response.json())
            .then((data) => {
                this.setState({ data: data });
            })
            .catch((error) => console.error(error))
            .finally(() => {
                this.setState({ isLoading: false });
            });
    }
    render() {
        let data = this.state.data
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
export default Padres