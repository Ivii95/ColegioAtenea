import React, { Component } from 'react'
import { View, StyleSheet, Text, Alert } from 'react-native'
import LoginLayout from '../layouts/loginLayout'
class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
        }
    }
    render() {
        let { username, password, loading, message } = this.state
        return (
            <LoginLayout
                state={this.state}
                data={this.props.data} />
        )
    }
}

export default Login