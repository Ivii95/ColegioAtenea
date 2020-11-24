import React, { Component } from 'react'
import HeaderLayout from '../layouts/headerLayout'
class Header extends Component{
    constructor(props) {
        super(props);
        this.state = {
            text:props.text
        }
    }
    render(){
        return(
            <HeaderLayout text={this.state.text}/>
        )
    }
}

export default Header