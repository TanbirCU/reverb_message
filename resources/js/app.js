import './bootstrap';
import Echo from "laravel-echo";

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'local',
    wsHost: window.location.hostname,
    wsPort: 8080,
    forceTLS: false,
    disableStats: true,
});
