// resources/js/firebase.js
import { initializeApp } from "firebase/app";
import { getMessaging, getToken,onMessage } from "firebase/messaging";
// import toastr from 'toastr';
// import 'toastr/build/toastr.min.css';
// Firebase configuration (replace with your actual config)
const firebaseConfig = {
    apiKey: "AIzaSyDX4nbzPKI2zPPNsWKEvjEe0M68rI9e1xM",
    authDomain: "notify-7dae4.firebaseapp.com",
    databaseURL: "https://notify-7dae4-default-rtdb.firebaseio.com",
    projectId: "notify-7dae4",
    storageBucket: "notify-7dae4.appspot.com",
    messagingSenderId: "75917189945",
    appId: "1:75917189945:web:13cd2b404a99f69e4ffee8",
    measurementId: "G-577F8BZ8BY"
};
console.log('test');
// Initialize Firebase
const firebaseApp = initializeApp(firebaseConfig);

// Retrieve Firebase Messaging object
const messaging = getMessaging(firebaseApp);

// Register the service worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
    .then((registration) => {
        // Pass the service worker registration to the messaging instance
        getToken(messaging, { serviceWorkerRegistration: registration, vapidKey: 'BLizf6KLHXMwE0JjtOWaDnIDp7HDSWxHHpgAf7IlY8lC_LIRQhFcJhKbjADG1DrUeq0gD8tEg4ig6bUNHlsmO0M' })
        .then((currentToken) => {
            if (currentToken) {
                console.log('FCM Token:', currentToken);
            } else {
                console.log('No registration token available. Request permission to generate one.');
            }
        }).catch((err) => {
            console.error('An error occurred while retrieving token. ', err);
        });
    }).catch((err) => {
        console.error('Service worker registration failed, error:', err);
    });
    onMessage(messaging, (payload) => {
        console.log('Message received. ', payload);

        // Extract the notification data
        const title = payload.notification.title;
        const body = payload.notification.body;

        // Display a toast notification using Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success(body, title);
      });

} else {
    console.warn('Service workers are not supported in this browser.');
}
