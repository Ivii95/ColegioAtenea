import React from 'react';
import {  Button, Spinner, StyleSheet, Text, TextInput, View } from 'react-native';
import '../data.js';


export default class App extends React.Component {

  state = {
    username: "",
    password: "",
    loading: false,
    message: "",
  }

  setState(arg0: { username: string; password: string; loading: boolean; message: string; }) {
    this.state = arg0;
  }
  setUsername(username: string) {
    this.state.username = username
  }
  setPassword(password: string) {
    this.state.password = password
  }
  setLoading(loading: boolean) {
    this.state.loading = loading
  }
  setMessage(message: string) {
    this.state.message = message
  }

  login = async () => {
    const username = await AsyncStorage.getItem("username")
    const password = await AsyncStorage.getItem("password")
    if (username && password) {
      this.authenticate(username, password)
    }
  }
  props: any;
  componentDidMount() {
    this.login()
  }
  authenticate = (username, password) => {
    this.setState({ username, password, loading: true, message: "" })
    axios.get(`https://reactnativemaster.com/api/authenticate?username=${username}&password=${password}`)
      .then(async res => {
        this.setLoading(false)
        if (res.data.user_info.status === "Active") {
          await AsyncStorage.setItem("username", username)
          await AsyncStorage.setItem("password", password)
          this.props.navigation.navigate("Home")
        } else {
          this.setMessage("This account is not active")

        }
      })
      .catch(err => {
        this.setMessage("Error connecting to the server, Please try again later.");
      })
  }
  render() {
    return (
      <View style={styles.container1}>
        <View style={styles.inputView} >
          <TextInput
            style={styles.inputText}
            placeholder="Usuario..."
            placeholderTextColor="#003f5c"
            onChangeText={text => this.setUsername(text)} />
        </View>
        <View style={styles.inputView} >
          <TextInput
            style={styles.inputText}
            placeholder="Password..."
            placeholderTextColor="#003f5c"
            secureTextEntry
            onChangeText={text => this.setPassword(text)} />
        </View>
        <Button rounded style={styles.loginBtn} disabled={this.state.loading} onPress={() => this.authenticate(this.state.username, this.state.password)}>
          {
            this.state.loading ? <Spinner color="white" />
              :
              <Text style={{ color: "#fff" }}>LOGIN</Text>
          }
        </Button>
      </View>
    );
  }

}

const styles = StyleSheet.create({
  container1: {
    flex: 1,
    backgroundColor: '#ffcc67',
    alignItems: 'center',
    justifyContent: 'center',
  }, container2: {
    height: '80%',
    width: '100%',
    backgroundColor: '#663e45',
    alignItems: 'center',
    justifyContent: 'center',
  }, container3: {
    height: '60%',
    width: '80%',
    backgroundColor: '#a4b2bf',
    alignItems: 'center',
    justifyContent: 'center',
  },
  textos: {
    marginTop: 20,
    width: '80%',
    height: 30,
    borderColor: 'gray',
    borderWidth: 0
  },
  input: {
    width: '80%',
    height: 50,
    borderColor: 'gray',
    borderWidth: 1
  }, inputView: {
    width: "80%",
    backgroundColor: "#465881",
    borderRadius: 25,
    height: 50,
    marginBottom: 20,
    justifyContent: "center",
    padding: 20
  }, inputText: {
    height: 50,
    color: "white"
  }, loginBtn: {
    width: "80%",
    backgroundColor: "#fb5b5a",
    borderRadius: 25,
    height: 50,
    alignItems: "center",
    justifyContent: "center",
    marginTop: 40,
    marginBottom: 10
  },
});
