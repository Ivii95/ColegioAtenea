import React, { Component } from 'react'
import { View, StyleSheet, } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/padres';
import Footer from '../components/footer';

import * as G from '../functions/GLOBALES'
class Padres extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ID: G.ID,
            footer: 'Padres:' + G.USERNAME
        }
    }
    render() {
        let ID, footer = this.state
        return (
            <View style={{ flex: 1 }}>
                <Header />
                <Body id={ID} />
                <Footer footer={footer} />
            </View>
        );
    }
}
export default Padres