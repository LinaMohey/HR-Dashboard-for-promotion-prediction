import firebase from "firebase";

// web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyAucAO6ihE2YrhxZJb6xO_7O62TxvvmlSk",
  authDomain: "employee-managment-auth.firebaseapp.com",
  projectId: "employee-managment-auth",
  storageBucket: "employee-managment-auth.appspot.com",
  messagingSenderId: "191591608189",
  appId: "1:191591608189:web:38e018f25275d6c6882614",
};

// Initialize Firebase
export const fb = firebase.initializeApp(firebaseConfig);
