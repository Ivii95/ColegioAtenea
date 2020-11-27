import React, { Component } from 'react'
import PadreLayout from '../layouts/padreLayout'

class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
            Hijos: [
                {
                    id: '1',
                    ide: 'funcion',
                    title: 'Mi Cuenta',
                    url: require('../img/micuenta.png'),
                },
                {
                    id: '2',
                    ide: 'funcion',
                    title: 'Circulares',
                    url: require('../img/circulares.png'),
                },
                {
                    id: '3',
                    ide: 'funcion',
                    title: 'Agenda',
                    url: require('../img/agenda.png'),
                },
                {
                    id: '4',
                    ide: 'hijo',
                    title: 'Lucia',
                    url: require('../img/agenda.png'),
                },
                {
                    id: '5',
                    ide: 'hijo',
                    title: 'Alberto',
                    url: require('../img/agenda.png'),
                }
            ]
        }
    }
    render() {
        let Hijos = this.state.Hijos
        return (
            <PadreLayout
                Hijos={Hijos}
            />
        )
    }
}

export default Body