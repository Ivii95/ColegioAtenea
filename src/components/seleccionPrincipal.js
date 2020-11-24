import React, { Component } from 'react'
import ContainerLayout from '../layouts/seleccionPrincipal'
import * as G from '../functions/GLOBALES'
class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
            //Los items son los objetos que se mostraran en el FlatList del contenido final.
            Items: [
                {
                    id: '1',
                    title: G.ALUMNO,
                    url: require('../img/alumnos.png'),
                },
                {
                    id: '2',
                    title: G.PADRES,
                    url: require('../img/padres.png'),
                },
                {
                    id: '3',
                    title: G.PROFESOR,
                    url: require('../img/profesores.png'),
                }
            ]
        }
    }
    render() {
        return (
            <ContainerLayout
                Items={this.state.Items}
            />
        )
    }
}

export default Body