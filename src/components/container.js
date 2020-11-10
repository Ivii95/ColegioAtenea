import React, { Component } from 'react'
import { View, StyleSheet, Text } from 'react-native'
import BodyLayout from '../layouts/containerLayout'
import LoginLayout from '../layouts/loginLayout'
class Body extends Component {
    constructor(props) {
        super(props);
        this.state = {
            username: '',
            password: '',
            loading: false,
            message: 'Aplicaciones-NT'
        }
    }
    render() {
        let { username } = this.state.username
        let { password } = this.state.password
        let { loading } = this.state.loading
        let { message } = this.state.message
        return (
                this.state.loading == false
                ?
                <LoginLayout state={this.state}/>
                //<AppLayout message={message} loading={loading}/>
                :
                <BodyLayout message={this.state.message}/>

        )
    }
}

export default Body