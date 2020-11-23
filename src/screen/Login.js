import React, { Component } from 'react'
import { View, StyleSheet, } from 'react-native'
//SMART COMPONENTS
import Header from '../components/header';
import Body from '../components/login';
import Footer from '../components/footer';

class Login extends Component {
    constructor(props) {
        super(props);

        this.state = {
            data: [],
            isLoading: true
        };
    }
    async componentDidMount() {
        await fetch('http://192.168.0.223:80/atenea/config.php?opcion=1')
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
        const { data, isLoading } = this.state;
        return (
            <View style={{ flex: 1 }}>
                <Header />
                <Body data={data}/>
                <Footer footer={'Aplicaciones-NT'} />
            </View>
        );
    }
}
export default Login