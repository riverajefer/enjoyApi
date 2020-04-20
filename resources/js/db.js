// Get a RTDB instance
import firebase from 'firebase/app'
import 'firebase/database'

export const db = firebase
    .initializeApp({
        databaseURL: "https://enjoy-8d34b.firebaseio.com"
    })
    .database()
