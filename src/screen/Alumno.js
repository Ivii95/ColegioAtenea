import React, { Component } from 'react'
import { View, StyleSheet, } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/alumnos';
import Footer from '../components/footer';
import * as G from '../functions/GLOBALES'
class Alumno extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ID: G.ID,
            footer: 'Alumno:' + G.USERNAME
        }
    }
    render() {
        let ID=this.state.ID
        let footer = this.state.footer
        return (
            <View style={{ flex: 1 }}>
                <Header />
                <Body id={ID} />
                <Footer footer={footer} />
            </View>
        );
    }
}
export default Alumno