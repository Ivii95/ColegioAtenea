import React, { Component } from 'react'
import AlumnoLayout from '../layouts/alumnoLayout'
class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
            name: props.name,
            curso: props.curso,
            tutor: props.tutor,
            tutoria: props.tutoria,
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
        //Se definenen las variables del componente para generarlo.
        let name = this.state.name
        let cursos = this.state.curso
        let tutor = this.state.tutor
        let tutorias = this.state.tutorias
        let Items = this.state.Items
        return (
            <AlumnoLayout
                Items={Items}
                name={name}
                curso={cursos}
                tutor={tutor}
                tutorias={tutorias}
            />
        )
    }
}

export default Body