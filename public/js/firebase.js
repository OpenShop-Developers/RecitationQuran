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
messaging.requestPermission()
    .then( ()=>{
        // console.log("Notification permission granted");
        return messaging.getToken();
    }).then( (token)=>{
    $('#device_token').val(token);
    // console.log(token);
}).catch( (err)=>{
    console.log("Unable to get permission to notify.",err);
});
//------------------------------------------------
messaging.onMessage( (payload)=>{
    console.log(payload);
});
