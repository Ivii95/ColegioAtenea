import * as React from 'react';
import { NavigationContainer, useNavigation, useRoute } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import Login from './src/screen/Login'
import Alumno from './src/screen/Alumno'
import Padres from './src/screen/Padres'
import Profesor from './src/screen/Profesor'
import Data from './src/screen/Data'
import { navigationRef } from './src/functions/RootNavigation';
import { View, Button, Text } from 'react-native';

const Stack = createStackNavigator();
function AppNavigator() {
    return (
        <NavigationContainer
            ref={navigationRef}
            fallback={<Text>Cargando...</Text>}
            options={{
                headerMode: 'none'
            }}
        >
            <Stack.Navigator
                initialRouteName="Login"
                screenOptions={{
                    headerShown: false
                }}>
                <Stack.Screen
                    name="Login"
                    component={Login}
                //options={{ headerShown: false}}
                />
                <Stack.Screen name="Alumno" component={Alumno} />
                <Stack.Screen name="Padres" component={Padres} />
                <Stack.Screen name="Profesor" component={Profesor} />
                <Stack.Screen name="Data" component={Data} />
            </Stack.Navigator>
        </NavigationContainer>
    );
}

export default AppNavigator;


/*
function loginNavigator({ screenName }) {
    const navigation = useNavigation();

    return (
        <Button
            title={`Ir ${screenName}`}
            onPress={() => navigation.navigate(screenName)}
        />
    );
}
YOUTUBE
const LoginNavigator = createStackNavigator({
    Login: {
        screen: Login,
        navigationOptions: {
            title: 'AteneApp'
        }
    },
    Alumnno: {
        screen: Alumno,
        navigationOptions: {
            title: 'Alumno de Atenea'
        }
    }
}, { headerLAyoutPreset: 'center' });

export default createAppContainer(LoginNavigator)*/