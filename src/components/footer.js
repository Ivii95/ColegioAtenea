import React, { Component} from 'react'
import FooterLayout from '../layouts/footerLayout'
class Footer extends Component {
    constructor(props) {
        super(props);
        this.state = {
            footer:props.footer
        }
    }
    render() {
        let  footer  = this.state.footer
        return (
            <FooterLayout footer={footer} />
        )
    }
}

export default Footer