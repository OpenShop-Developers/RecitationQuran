importScripts("https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js");
var firebaseConfig = {
    apiKey: "AIzaSyCd59DcYvNArN-I886icsQOzUWsPuhrEDQ",
    authDomain: "tasmee3-5cfe0.firebaseapp.com",
    databaseURL: "https://tasmee3-5cfe0.firebaseio.com",
    projectId: "tasmee3-5cfe0",
    storageBucket: "tasmee3-5cfe0.appspot.com",
    messagingSenderId: "1088426421954",
    appId: "1:1088426421954:web:be760e46fe972d3d27d55b",
    measurementId: "G-6TMLVTVP1E"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/firebase-logo.png"
    };
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});
