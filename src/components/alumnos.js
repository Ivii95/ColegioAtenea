import React, { Component } from 'react'
import AlumnoLayout from '../layouts/alumnoLayout'
class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
            username: props.username,
            loading: false,
            Items: [
                {
                    id: '1',
                    title: 'ZonaComunicacion.png',
                    url: require('../img/ZonaComunicacion.png'),
                },
                {
                    id: '2',
                    title: 'Ejercicios, Examenes',
                    url: require('../img/SeguimientoEducativo.png'),
                }, {
                    id: '3',
                    title: 'Ejercicios, Examenes',
                    url: require('../img/evaluaciones.png'),
                }, {
                    id: '4',
                    title: 'Ejercicios, Examenes',
                    url: require('../img/Horarios.png'),
                }
            ]
        }
    }
    render() {
        let username = this.state.username
        let message = this.state.message
        let Items = this.state.Items
        return (
            <AlumnoLayout
                Items={Items}
                username={username}
                message={message}
                name='Alberto Sanguino Acedo'
                curso='S3A'
                tutor='Juan Carlos Merchán Salas'
                tutorias='Miércoles, de 08:20 - 09:15 h.'
            />
        )
    }
}

export default Body