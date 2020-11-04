import React, { Component } from 'react'
import { View, Text, StyleSheet, Alert } from 'react-native'
import AppLayout from './layout/appLayout'
class APPtenea extends Component {
    constructor(props){
        super(props);
        this.state = {
            username: '',
            password: '',
            loading: false,
            message: 'Aplicaciones-NT'
        }
    }
    login = () => {
        this.setState({
            username : this.state.username
        })
    }
    alerta = () => { Alert.alert ('Prueba de alerta') }
    render() {
        let {username} = this.state
        let {password} = this.state
        let {loading}= this.state
        let {message}= this.state
        return (
            <AppLayout/>
        );
    }
}

export default APPtenea