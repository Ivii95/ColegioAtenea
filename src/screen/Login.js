import React, { Component } from 'react'
import { View, StyleSheet, } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/container';
import Footer from '../components/footer';
class AteneApp extends Component {
    render() {
        return (
            <View style={{flex:1}}>
                <Header />
                <Body />
                <Footer />
            </View>
        );
    }
}
export default AteneApp