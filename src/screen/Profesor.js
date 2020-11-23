import React, { Component } from 'react'
import { View, Alert } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/profesor';
import Footer from '../components/footer';

import * as G from '../functions/GLOBALES'
//API
import api from '../functions/api'
class Profesor extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: G.ID,
            footer: 'Profesor: ' + G.NAME,
        }
    }
    /*async componentDidMount() {
        await fetch('http://192.168.0.223:80/atenea/config.php?opcion=1')
            .then((response) => response.json())
            .then((data) => {
                this.setState({ data: data });
            })
            .catch((error) => console.error(error))
            .finally(() => {
                this.setState({ isLoading: false });
            });
    }*/
    render() {
        let ID, footer = this.states
        return (
            <View style={{ flex: 1 }}>
                <Header />
                <Body id={ID} />
                <Footer footer={footer} />
            </View>
        );
    }
}
export default Profesor