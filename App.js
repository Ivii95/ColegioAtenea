import React, { Component } from 'react'
import { createAppContainer, } from 'react-navigation'
import {createStackNavigator} from 'react-navigation-stack'
import Login from './src/screen/Login'

const LoginNavigator = createStackNavigator({
    Login : {
        screen : Login,
        navigationOptions:{
            title:'AteneApp'
        }
    }
},{headerMode:'none'})

export default createAppContainer(LoginNavigator)