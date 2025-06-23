import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

const firebaseConfig = {
    apiKey: "AIzaSyBW3o5yLi2KL6ukMvBAasmFLU9YHN2IpY8",
    authDomain: "steinlie-realtime.firebaseapp.com",
    databaseURL: "https://steinlie-realtime-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "steinlie-realtime",
    storageBucket: "steinlie-realtime.appspot.com",
    messagingSenderId: "324833723114",
    appId: "1:324833723114:web:e0f40337c88722f20c0d93",
    measurementId: "G-X7HFCJ9287"
};

const app = initializeApp(firebaseConfig);

export const db = getDatabase(app);
