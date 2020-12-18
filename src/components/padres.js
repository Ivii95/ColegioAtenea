import React, { Component } from 'react'
import PadreLayout from '../layouts/padreLayout'
import * as G from '../functions/GLOBALES'

class Body extends Component {
    constructor(props) {
        super(props)
        this.state = {
            Alumnos: props.data.Alumnos,
            Hijos: [
                {
                    id: 1,
                    ide: 'funcion',
                    title: 'Mi Cuenta',
                    url: require('../img/micuenta.png'),
                },
                {
                    id: 2,
                    ide: 'funcion',
                    title: 'Circulares',
                    url: require('../img/circulares.png'),
                },
                {
                    id: 3,
                    ide: 'funcion',
                    title: 'Agenda',
                    url: require('../img/agenda.png'),
                }
            ]
        }
    }
    render() {
        let Hijos = this.state.Hijos;
        /*const Alumnos= this.state.Alumnos
        const datos = Object.keys(Alumnos).map(key => ({
            key,
            ...Alumnos[key]
        }));
        console.log(datos)
        /*for (const datos of Alumnos) {
            Hijos.push({
                id: datos.id,
                ide: 'hijo',
                title: datos.title,
                url: ''
            });
            console.log(datos)
        }*/
        //console.log(Alumnos);
        /*this.props.data.Alumnos.map(element => {
            Hijos.push({
                id: element.id,
                ide: 'hijo',
                title: element.title,
                url: ''
            });
        });*/
        Hijos.push({
            id: 4,
            ide: 'hijo',
            title: 'Hijos',
            url: ''
        });
        return (
            <PadreLayout
                Hijos={Hijos}
                data={this.props.data}
            />
        )
    }
}
export default Body