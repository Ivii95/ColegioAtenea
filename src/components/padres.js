import React, { Component } from 'react'
import PadreLayout from '../layouts/padreLayout'

class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
            username: props.username,
            loading: false,
            Items: [
                {
                    id: '1',
                    title: 'Mi Cuenta',
                    url: require('../img/micuenta.png'),
                },
                {
                    id: '2',
                    title: 'Circulares',
                    url: require('../img/circulares.png'),
                },
                {
                    id: '3',
                    title: 'Agenda',
                    url: require('../img/agenda.png'),
                }
            ],
             Hijos: [
                {
                    id: '57',
                    title: 'Lucia',
                },
                {
                    id: '58',
                    title: 'Alberto',
                }

            ]
        }
    }
    render() {
        let username = this.state.username
        let message = this.state.message
        let Hijos = this.state.Hijos
        let Items = this.state.Items
        return (
            <PadreLayout
                username={username}
                message={message}
                Hijos={Hijos}
                Items={Items}
            />
        )
    }
}

export default Body