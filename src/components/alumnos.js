import React, { Component } from 'react'
import AlumnoLayout from '../layouts/alumnoLayout'
class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
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
                },
                {
                    id: '3',
                    title: 'Evaluaciones',
                    url: require('../img/evaluaciones.png'),
                },
                {
                    id: '4',
                    title: 'Horarios',
                    url: require('../img/Horarios.png'),
                }
            ]
        }
    }

    render() {
        //Se definen las variables del componente para generarlo.
        let Items = this.state.Items
        return (
            <AlumnoLayout
                Items={Items}
                data={this.props.data}
            />
        )
    }
}

export default Body